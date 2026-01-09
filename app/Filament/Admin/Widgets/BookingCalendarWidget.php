<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Data\EventData;

class BookingCalendarWidget extends FullCalendarWidget
{
    // Widget melebar penuh
    protected int | string | array $columnSpan = 'full';

    // Urutan widget (paling atas)
    protected static ?int $sort = 1;

    public function config(): array
    {
        return [
            // --- 1. HEADER (ATAS) ---
            'headerToolbar' => [
                'left' => 'prev,next today',  // Tambah tombol 'Hari Ini' biar navigasi cepat
                'center' => 'title',
                'right' => '',
            ],

            // --- 2. FOOTER (BAWAH) ---
            'footerToolbar' => [
                'right' => 'dayGridMonth,timeGridWeek,listWeek', // Ganti 'listMonth' jadi 'timeGridWeek' agar terlihat jam-nya
            ],

            // --- 3. UI/UX TEXT ---
            'buttonText' => [
                'today' => 'Hari Ini',
                'month' => 'Bulan',
                'timeGridWeek' => 'Mingguan', // Tampilan mingguan dengan jam
                'list'  => 'Agenda',
            ],

            // --- 4. SETTING JAM & TAMPILAN ---
            'initialView' => 'dayGridMonth',
            'dayMaxEvents' => 2,
            'moreLinkClick' => 'week', 
            'height' => 'auto',
            'contentHeight' => 'auto',
            'firstDay' => 1, // Senin
            
            // Format jam (24 jam, bukan AM/PM)
            'slotLabelFormat' => [
                'hour' => '2-digit',
                'minute' => '2-digit',
                'hour12' => false
            ],
            'eventTimeFormat' => [
                'hour' => '2-digit',
                'minute' => '2-digit',
                'hour12' => false
            ],
            
            // Batas jam kerja di tampilan mingguan (agar tidak terlalu panjang ke bawah)
            'slotMinTime' => '06:00:00', // Mulai jam 6 pagi
            'slotMaxTime' => '20:00:00', // Selesai jam 8 malam
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return Booking::query()
            ->whereIn('status', ['approved', 'pending'])
            ->where('tanggal_mulai', '>=', $fetchInfo['start'])
            ->where('tanggal_selesai', '<=', $fetchInfo['end'])
            ->get()
            ->map(function (Booking $booking) {
                
                $color = $booking->status === 'approved' ? '#10b981' : '#f59e0b';

                return EventData::make()
                    ->id($booking->id)
                    // Tampilkan Jam di Judul juga biar jelas
                    // Format: "08:00 - Fahmi : Tenda"
                    ->title($booking->tanggal_mulai->format('H:i') . ' - ' . $booking->member->nama . ' : ' . $booking->asset->nama_alat) 
                    
                    // PENTING: Gunakan toIso8601String() atau format lengkap agar jam terbaca oleh FullCalendar
                    ->start($booking->tanggal_mulai->toIso8601String()) 
                    ->end($booking->tanggal_selesai->toIso8601String())
                    
                    ->backgroundColor($color)
                    ->borderColor($color)
                    ->url(route('filament.admin.resources.bookings.edit', $booking)) 
                    ->toArray();
            })
            ->toArray();
    }
}