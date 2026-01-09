<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Asset;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    // Auto-refresh setiap 5 detik agar admin bisa lihat perubahan real-time tanpa refresh
    protected static ?string $pollingInterval = '5s'; 

    protected function getStats(): array
    {
        // --- 1. HITUNG DATA REAL-TIME ---
        
        // Total Aset
        $totalAset = Asset::count();
        
        // Sedang Dipinjam (Menggunakan Relasi activeBooking yang sudah dibuat di Model)
        // Logika: Cari aset yang PUNYA (whereHas) relasi activeBooking
        $sedangDipinjam = Asset::whereHas('activeBooking')->count();
            
        // Rusak (Status fisik)
        $rusak = Asset::where('status_alat', '!=', 'Baik')->count();
        
        // Tersedia: Total - (Dipinjam + Rusak)
        // Asumsi: Barang rusak tidak bisa dipinjam, jadi statusnya mutually exclusive
        // Atau hitung manual: Status Baik DAN Tidak punya activeBooking
        $tersedia = Asset::where('status_alat', 'Baik')
            ->whereDoesntHave('activeBooking') // Kebalikan dari whereHas
            ->count();


        // --- 2. LOGIKA GRAFIK ---
        
        $chartTersedia = $tersedia > 0 
            ? [7, 7, 7, 7, 7, 7, 7] 
            : [0, 0, 0, 0, 0, 0, 0];

        $chartDipinjam = $sedangDipinjam > 0 
            ? [2, 10, 5, 15, 8, 20, 10] 
            : [0, 0, 0, 0, 0, 0, 0]; 

        $chartRusak = $rusak > 0 
            ? [10, 2, 20, 5, 30, 10, 40] 
            : [0, 0, 0, 0, 0, 0, 0]; 


        // --- 3. TAMPILKAN WIDGET ---
        return [
            Stat::make('Total Aset', $totalAset)
                ->description('Seluruh inventaris')
                ->icon('heroicon-m-cube')
                ->color('gray')
                ->chart([1, 2, 3, 4, 5, 4, 3]),

            Stat::make('Tersedia', $tersedia)
                ->description('Siap digunakan')
                ->icon('heroicon-m-check-circle')
                ->color($tersedia > 0 ? 'success' : 'gray')
                ->chart($chartTersedia),

            Stat::make('Sedang Dipinjam', $sedangDipinjam)
                ->description('Belum kembali')
                ->icon('heroicon-m-clock')
                ->color($sedangDipinjam > 0 ? 'warning' : 'gray') // Kuning jika ada yang pinjam
                ->chart($chartDipinjam),

            Stat::make('Kondisi Rusak', $rusak)
                ->description('Perlu perbaikan')
                ->icon('heroicon-m-x-circle')
                ->color($rusak > 0 ? 'danger' : 'success')
                ->chart($chartRusak),
        ];
    }
}