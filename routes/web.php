<?php

use Illuminate\Support\Facades\Route;
use App\Models\Asset;
use App\Models\Member;
use App\Models\Activity;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Halaman Depan (Landing Page)
Route::get('/', function () {
    // --- 1. LOGIKA ASET (REAL-TIME) ---
    $assets = Asset::with(['activeBooking.member'])->get()->map(function($asset) {
        // Default lokasi adalah posisi awal di database, atau 'Gudang' jika kosong
        $lokasi = $asset->posisi_awal ?? 'Gudang';

        if ($asset->activeBooking) {
            $asset->status_realtime = 'Dipinjam';
            // UBAH LOKASI MENJADI NAMA PEMINJAM
            // Menggunakan optional() untuk jaga-jaga jika data member terhapus
            $peminjam = optional($asset->activeBooking->member)->nama ?? 'Anggota';
            $asset->lokasi_display = 'Sdr/i ' . $peminjam; 
        } elseif ($asset->status_alat === 'Rusak') {
            $asset->status_realtime = 'Rusak';
            $asset->lokasi_display = $lokasi;
        } else {
            $asset->status_realtime = 'Tersedia';
            $asset->lokasi_display = $lokasi;
        }
        return $asset;
    });

    // 2. Ambil Pengurus (Hanya yang Aktif & Punya Foto, Acak 3 orang)
    // Jika ingin menampilkan semua, hapus ->take(3)
    $pengurus = Member::whereIn('status', ['Aktif', 'Alumni'])
                    // ->whereNotNull('avatar') // Hanya yang sudah upload foto
                    ->orderByRaw("CASE WHEN status = 'Aktif' THEN 1 WHEN status = 'Alumni' THEN 2 ELSE 3 END")
                    ->orderBy('nama', 'asc') // Urutkan nama A-Z setelah status
                    ->limit(20) // Ambil maksimal 20 orang (opsional)
                    ->get();

    // 3. Ambil Kegiatan Terbaru
    $activities = Activity::where('is_published', true)
        ->latest('tanggal')
        ->take(3) // Ambil 3 terbaru
        ->get();

    return view('welcome', compact('assets', 'pengurus', 'activities'));
});

Route::get('/kegiatan/{activity:slug}', function (App\Models\Activity $activity) {
    // Pastikan hanya yang published yang bisa dibuka
    if (! $activity->is_published) {
        abort(404);
    }
    // 2. LOGIKA BARU: Ambil 3 berita lain (kecuali berita ini)
    $otherActivities = App\Models\Activity::where('is_published', true)
        ->where('id', '!=', $activity->id) // Jangan ambil berita yang sedang dibuka
        ->latest('tanggal')
        ->take(10) // Ambil 3 saja
        ->get();

    return view('activity', compact('activity', 'otherActivities'));
})->name('activity.show');

// 2. Redirect Login (Opsional, untuk keamanan)
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

// 3. Rute Booking (Menggunakan Controller Baru)
// Menampilkan Form
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
// Memproses Data (Simpan)
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store')->middleware('throttle:5,1');

// 4. Rute Cetak PDF Surat Jalan
Route::get('/booking/{booking}/print', [PdfController::class, 'cetakSuratJalan'])->name('booking.print');


        
