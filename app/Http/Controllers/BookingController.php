<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Asset;
use App\Models\Member; // Tambahkan ini
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create()
    {
        // Kirim data Aset DAN Member ke view
        $assets = Asset::all();
        $members = Member::all(); // Tambahkan ini agar tidak error "Undefined variable $members"
        
        return view('booking', compact('assets', 'members'));
    }

    public function store(Request $request)
    {
        // 1. Gabungkan Tanggal & Jam
        $waktuMulai = $request->tgl_mulai_date . ' ' . $request->tgl_mulai_time;
        $waktuSelesai = $request->tgl_selesai_date . ' ' . $request->tgl_selesai_time;

        // 2. Validasi
        $start = Carbon::parse($waktuMulai);
        $end = Carbon::parse($waktuSelesai);

        if ($end->lessThanOrEqualTo($start)) {
            return back()->with('error', 'Jam pengembalian harus setelah jam pengambilan!');
        }

        // 3. Cek Bentrok (Real-time)
        $isBooked = Booking::where('asset_id', $request->asset_id)
            ->where('status', 'approved')
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('tanggal_mulai', [$start, $end])
                      ->orWhereBetween('tanggal_selesai', [$start, $end])
                      ->orWhere(function ($q) use ($start, $end) {
                          $q->where('tanggal_mulai', '<', $start)
                            ->where('tanggal_selesai', '>', $end);
                      });
            })
            ->exists();

        if ($isBooked) {
            return back()->with('error', 'Maaf, alat ini sudah dibooking pada jam tersebut.');
        }

        // 4. Simpan
        Booking::create([
            'member_id' => $request->member_id,
            'asset_id' => $request->asset_id,
            'tanggal_mulai' => $waktuMulai,
            'tanggal_selesai' => $waktuSelesai,
            'keperluan' => $request->keperluan,
            'status' => 'pending',
        ]);

        return redirect('/')->with('success', 'Booking berhasil dikirim!');
    }
}