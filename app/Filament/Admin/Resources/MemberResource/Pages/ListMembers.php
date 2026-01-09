<?php

namespace App\Filament\Admin\Resources\MemberResource\Pages;

use App\Filament\Admin\Resources\MemberResource;
use App\Filament\Exports\MemberExporter; // <-- Import ini
use App\Filament\Imports\MemberImporter; // <-- Import ini
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tombol Export
            Actions\ExportAction::make()
                ->exporter(MemberExporter::class)
                ->label('Export')
                ->color('success'), 

            // Tombol Import
            Actions\ImportAction::make()
                ->importer(MemberImporter::class)
                ->label('Import')
                ->color('warning'),

            Actions\CreateAction::make(),
        ];
    }
}