<?php

namespace App\Filament\Imports;

use App\Models\Member;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MemberImporter extends Importer
{
    protected static ?string $model = Member::class;

    public static function getColumns(): array
{
    return [
        ImportColumn::make('nama')
            ->requiredMapping()
            ->rules(['required', 'max:255']),
        ImportColumn::make('nomor_hp')
            ->rules(['max:255']),
        ImportColumn::make('generasi')
            ->numeric(),
        ImportColumn::make('status')
            ->requiredMapping(),
        ImportColumn::make('alamat'),
        ImportColumn::make('kota'),
    ];
}

// Ganti 'email' jadi 'nama' atau 'nomor_hp' sebagai identitas unik agar tidak duplikat
public function resolveRecord(): ?Member
{
    return Member::firstOrNew([
        'nama' => $this->data['nama'], 
    ]);
}

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your member import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
