<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Booking;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function checkAvailability(Request $request)
        {
            // 1. Ambil data dari input Javascript
        $assetIds = $request->input('asset_ids', []); // Array ID alat
        $startDate = $request->input('tgl_mulai_date');
        $startTime = $request->input('tgl_mulai_time');
        $endDate = $request->input('tgl_selesai_date');
        $endTime = $request->input('tgl_selesai_time');

         // Jika data tanggal belum lengkap, anggap tersedia dulu (jangan error)
        if (!$startDate || !$endDate || empty($assetIds)) {
            return response()->json(['available' => true]);
        }

        // Gabungkan tanggal dan waktu
        $start = $startDate . ' ' . ($startTime ?? '00:00:00');
        $end = $endDate . ' ' . ($endTime ?? '23:59:59');

        foreach ($assetIds as $assetId) {
            // Cek Bentrok Waktu
            $conflict = Booking::where('asset_id', $assetId)
                ->whereIn('status', ['approved', 'pending']) // Cek yang statusnya aktif
                ->where(function ($query) use ($start, $end) {
                    $query->where('tanggal_mulai', '<', $end)
                          ->where('tanggal_selesai', '>', $start);
                })
                ->first(); // Ambil data booking yang bentrok (jika ada)

            if ($conflict) {
                // Ambil nama alat
                $asset = Asset::find($assetId);
                
                // Format tanggal biar enak dibaca
                $bookedStart = \Carbon\Carbon::parse($conflict->tanggal_mulai)->format('d M H:i');
                $bookedEnd = \Carbon\Carbon::parse($conflict->tanggal_selesai)->format('d M H:i');

                return response()->json([
                    'available' => false,
                    'message' => "Alat '{$asset->nama_alat}' sudah dibooking pada tanggal {$bookedStart} s/d {$bookedEnd}. Silakan cari tanggal lain atau hapus alat tersebut."
                ]);
            }
        }

        // Jika lolos semua cek
        return response()->json(['available' => true]);
    }




    public function create()
    {
        $assets = Asset::where('status_alat', '!=', 'Rusak')->get();
        $members = Member::all();
        return view('booking', compact('assets', 'members'));
    }

    public function store(Request $request)
    {
        // --- 1. FITUR OTOMATIS: UBAH STATUS JADI 'RETURNED' JIKA SUDAH LEWAT ---
        // Sebelum validasi, kita update dulu semua data lama di database.
        // Jika status masih 'approved' TAPI waktu selesai < waktu sekarang, ubah jadi 'returned'.
        Booking::where('status', 'approved')
            ->where('tanggal_selesai', '<', now())
            ->update(['status' => 'returned']);

        // --- 2. VALIDASI INPUT ---
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'asset_ids' => 'required|array|min:1|max:4', 
            'asset_ids.*' => 'required|exists:assets,id',
            'tgl_mulai_date' => 'required|date',
            'tgl_mulai_time' => 'required',
            'tgl_selesai_date' => 'required|date|after_or_equal:tgl_mulai_date',
            'tgl_selesai_time' => 'required',
            'keperluan' => 'required|string',
        ]);

        $tgl_peminjaman = $validated['tgl_mulai_date'] . ' ' . $validated['tgl_mulai_time'];
        $tgl_pengembalian = $validated['tgl_selesai_date'] . ' ' . $validated['tgl_selesai_time'];

        try {
            foreach ($request->asset_ids as $assetId) {
                
                // --- 3. LOGIKA CEK BENTROK YANG LEBIH CERDAS ---
                // Kita cek apakah ada booking LAIN yang statusnya AKTIF (approved/pending)
                // DAN waktunya bertabrakan dengan rencana peminjaman kita.
                
                $isBooked = Booking::where('asset_id', $assetId)
                    ->whereIn('status', ['approved', 'pending']) // Cek status aktif
                    ->where(function ($query) use ($tgl_peminjaman, $tgl_pengembalian) {
                        // Rumus Cek Bentrok Waktu:
                        // (Start A <= End B) and (End A >= Start B)
                        $query->where('tanggal_mulai', '<', $tgl_pengembalian)
                              ->where('tanggal_selesai', '>', $tgl_peminjaman);
                    })
                    ->exists();

                if ($isBooked) {
                    // Ambil nama alat biar pesan error jelas
                    $namaAlat = Asset::find($assetId)->nama_alat;
                    return back()->with('error', "Alat '{$namaAlat}' sudah dibooking orang lain pada jam tersebut.");
                }

                // Buat Booking Baru
                Booking::create([
                'member_id' => $validated['member_id'],
                'asset_id' => $assetId,
                'tanggal_mulai' => $tgl_peminjaman,   
                'tanggal_selesai' => $tgl_pengembalian, 
                'keperluan' => $validated['keperluan'],
    
                     // UBAH DARI 'approved' MENJADI 'pending'
                'status' => 'pending', 
        ]);
            }


            return redirect('/')->with('success', 'Booking berhasil diajukan!');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Gagal Booking: " . $e->getMessage());
            return back()->with('error', 'Maaf, terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }
}