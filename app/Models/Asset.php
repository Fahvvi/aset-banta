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
    public function activeBooking()
    {
        return $this->hasOne(Booking::class)
            ->where('status', 'approved') // Hanya yang disetujui
            ->where('tanggal_mulai', '<=', now()) // Sudah mulai
            ->where('tanggal_selesai', '>=', now()) // Belum selesai
            ->latest();
    }
}