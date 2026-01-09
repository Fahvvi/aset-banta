<?php

use Illuminate\Support\Facades\Route;
use App\Models\Asset;
use App\Models\Member;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Halaman Depan (Landing Page)
Route::get('/', function () {
    // Kita load relasi 'activeBooking' agar frontend tahu statusnya
    $assets = Asset::with(['activeBooking'])->get()->map(function($asset) {
        // Kita tambahkan atribut 'status_realtime' manual ke JSON
        if ($asset->activeBooking) {
            $asset->status_realtime = 'Dipinjam';
            $asset->peminjam_nama = $asset->activeBooking->member->nama ?? 'Anggota';
        } else {
            $asset->status_realtime = 'Tersedia';
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

    return view('welcome', compact('assets', 'pengurus'));
});

// 2. Redirect Login (Opsional, untuk keamanan)
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

// 3. Rute Booking (Menggunakan Controller Baru)
// Menampilkan Form
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
// Memproses Data (Simpan)
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// 4. Rute Cetak PDF Surat Jalan
Route::get('/booking/{booking}/print', [PdfController::class, 'cetakSuratJalan'])->name('booking.print');

