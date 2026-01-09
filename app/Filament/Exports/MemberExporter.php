<?php

namespace App\Filament\Exports;

use App\Models\Member;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MemberExporter extends Exporter
{
    protected static ?string $model = Member::class;

   public static function getColumns(): array
{
    return [
        ExportColumn::make('nama')->label('Nama Lengkap'),
        ExportColumn::make('nomor_hp')->label('No HP'),
        ExportColumn::make('generasi')->label('Angkatan'),
        ExportColumn::make('status'),
        ExportColumn::make('alamat'),
        ExportColumn::make('kota')->label('Domisili'),
    ];
}

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your member export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
