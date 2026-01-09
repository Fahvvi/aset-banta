<?php

namespace App\Filament\Admin\Resources\AssetResource\Pages;

use App\Filament\Admin\Resources\AssetResource;
use App\Filament\Exports\AssetExporter; // <-- Import
use App\Filament\Imports\AssetImporter; // <-- Import
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssets extends ListRecords
{
    protected static string $resource = AssetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->exporter(AssetExporter::class)
                ->label('Export')
                ->icon('heroicon-m-arrow-down-tray')
                ->color('info'),

            Actions\ImportAction::make()
                ->importer(AssetImporter::class)
                ->label('Import')
                ->icon('heroicon-m-arrow-up-tray')
                ->color('warning'),

            Actions\CreateAction::make(),
        ];
    }
}