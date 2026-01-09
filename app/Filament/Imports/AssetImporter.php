<?php

namespace App\Filament\Imports;

use App\Models\Asset;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class AssetImporter extends Importer
{
    protected static ?string $model = Asset::class;

    public static function getColumns(): array
{
    return [
        ImportColumn::make('nama_alat')->requiredMapping()->rules(['required']),
        ImportColumn::make('posisi_awal'),
        ImportColumn::make('harga_beli')->numeric(),
        ImportColumn::make('tanggal_pembelian')->rules(['date']),
        ImportColumn::make('status_alat')->default('Baik'),
    ];
}

public function resolveRecord(): ?Asset
{
    // Cari berdasarkan nama alat, kalau gak ada buat baru
    return Asset::firstOrNew([
        'nama_alat' => $this->data['nama_alat'],
    ]);
}

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your asset import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
