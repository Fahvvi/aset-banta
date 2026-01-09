<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function asset() {
        return $this->belongsTo(Asset::class);
    }
}
