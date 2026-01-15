<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi ke Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'peminjam_terbaru_id');
    }
    // FUNGSI PENGINTAI (Sangat Penting!)
    // Ini mencari booking yang statusnya APPROVED dan waktunya SEDANG BERLANGSUNG sekarang
    // --- PERBAIKAN LOGIKA DISINI ---
    public function activeBooking()
    {
        return $this->hasOne(Booking::class)
            ->where('status', 'approved')
            // Syarat 1: Waktu Mulai harus SUDAH LEWAT atau SEKARANG (Barang sudah diambil)
            ->where('tanggal_mulai', '<=', now()) 
            // Syarat 2: Waktu Selesai harus BELUM LEWAT (Barang belum dikembalikan)
            ->where('tanggal_selesai', '>=', now())
            ->latest();
    }
}