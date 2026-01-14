<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Asset;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAssetsWidget extends BaseWidget
{
    // Judul Widget
    protected static ?string $heading = 'Status Aset Real-time';
    
    // Memenuhi lebar layar
    protected int | string | array $columnSpan = 'full';

    // Urutan tampilan
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Menggunakan eager loading 'activeBooking.member' agar query lebih efisien
                Asset::query()->with('activeBooking.member')->latest('updated_at')
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_alat')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status_ketersediaan')
                    ->label('Status Real-time')
                    ->getStateUsing(function (Asset $record) {
                        // 1. Cek Booking Aktif (Real-time)
                        if ($record->activeBooking) {
                            return 'Dipinjam: ' . ($record->activeBooking->member->nama ?? 'Anggota');
                        }
                        // 2. Cek Kondisi Fisik
                        if ($record->status_alat === 'Rusak') {
                            return 'Rusak / Maintenance';
                        }
                        // 3. Default
                        return 'Tersedia';
                    })
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        str_contains($state, 'Tersedia') => 'success',
                        str_contains($state, 'Dipinjam') => 'warning', // Kuning agar mencolok
                        str_contains($state, 'Rusak') => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match (true) {
                        str_contains($state, 'Tersedia') => 'heroicon-m-check-circle',
                        str_contains($state, 'Dipinjam') => 'heroicon-m-clock',
                        default => 'heroicon-m-x-circle',
                    }),

                // --- UPDATE LOGIKA LOKASI DISINI ---
                Tables\Columns\TextColumn::make('posisi_awal')
                    ->label('Lokasi Terkini')
                    ->getStateUsing(function ($record) {
                        // Cek peminjaman
                        if ($record->activeBooking) {
                            $member = $record->activeBooking->member;
                            $nama = $member->nama ?? 'Anggota';
                            
                            // Gabung alamat (Alamat + Desa + Kota)
                            $alamat = collect([
                                $member->alamat, 
                                $member->desa, 
                                $member->kota
                            ])->filter()->join(', ');

                            // Jika alamat ada, tampilkan lengkap
                            if (!empty($alamat)) {
                                return "{$alamat} ({$nama})";
                            }
                            
                            // Jika alamat kosong, beri peringatan
                            return "⚠ ({$nama}) belum set alamat";
                        }

                        // Jika tidak dipinjam, kembalikan posisi awal
                        return $record->posisi_awal ?? 'Gudang';
                    })
                    ->wrap() // Agar teks panjang turun ke bawah
                    ->icon(fn ($state) => str_contains($state, 'belum set') ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-map-pin')
                    ->color(fn ($state) => str_contains($state, 'belum set') ? 'danger' : 'gray'),
            ])
            ->paginated([5, 10]);
    }
}