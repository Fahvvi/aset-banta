<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ActivityResource\Pages;
use App\Filament\Admin\Resources\ActivityResource\RelationManagers;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea; // atau RichEditor jika mau teks kaya
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Str;


class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Konten Kegiatan')
                ->schema([
                    TextInput::make('judul')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    DatePicker::make('tanggal')
                        ->required()
                        ->default(now()),

                    FileUpload::make('gambar')
                        ->image()
                        ->directory('kegiatan-images')
                        ->columnSpanFull(),

                    Textarea::make('deskripsi') // Ganti RichEditor::make('deskripsi') jika ingin bold/italic
                        ->rows(5)
                        ->columnSpanFull(),

                    Toggle::make('is_published')
                        ->label('Terbitkan?')
                        ->default(true),
                ])
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            ImageColumn::make('gambar')->square(),
            TextColumn::make('judul')->searchable()->weight('bold'),
            TextColumn::make('tanggal')->date()->sortable(),
            ToggleColumn::make('is_published')->label('Tayang'),
        ])
        ->defaultSort('tanggal', 'desc');
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
