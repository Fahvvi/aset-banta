<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function cetakSuratJalan(Booking $booking)
    {
        // Hanya cetak jika status approved atau returned
        if (!in_array($booking->status, ['approved', 'returned'])) {
            abort(403, 'Booking belum disetujui.');
        }

        $pdf = Pdf::loadView('pdf.surat_jalan', compact('booking'));
        return $pdf->download('Surat_Jalan_' . $booking->member->nama . '.pdf');
    }
}