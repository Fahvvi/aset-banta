<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BookingResource\Pages;
use App\Filament\Admin\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Member;
use App\Models\Asset;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Detail Peminjaman')
                ->schema([
                    // Select Member yang bisa dicari
                    Forms\Components\Select::make('member_id')
                        ->label('Peminjam')
                        ->options(Member::all()->pluck('nama', 'id'))
                        ->searchable()
                        ->required(),

                    // Select Asset yang bisa dicari
                    Forms\Components\Select::make('asset_id')
                        ->label('Barang')
                        ->options(Asset::all()->pluck('nama_alat', 'id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\DatePicker::make('tanggal_mulai')
                                ->required(),
                            Forms\Components\DatePicker::make('tanggal_selesai')
                                ->required()
                                ->afterOrEqual('tanggal_mulai'),
                        ]),
                    
                    Forms\Components\Textarea::make('keperluan')
                        ->columnSpanFull(),

                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Menunggu Persetujuan',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                            'returned' => 'Dikembalikan',
                        ])
                        ->required(),
                ]),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('member.nama')
                ->label('Peminjam')
                ->searchable()
                ->weight('bold'),

            Tables\Columns\TextColumn::make('asset.nama_alat')
                ->label('Barang'),

            Tables\Columns\TextColumn::make('tanggal_mulai')
                ->date('d M Y')
                ->label('Mulai'),

            Tables\Columns\TextColumn::make('tanggal_selesai')
                ->date('d M Y')
                ->label('Selesai'),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',   // Kuning
                    'approved' => 'success',  // Hijau
                    'rejected' => 'danger',   // Merah
                    'returned' => 'gray',     // Abu-abu
                }),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            // TOMBOL APPROVE
            Tables\Actions\Action::make('approve')
                ->label('Setujui')
                ->icon('heroicon-m-check')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (Booking $record) => $record->status === 'pending')
                ->action(function (Booking $record) {
                    // Ubah status booking jadi approved
                    $record->update(['status' => 'approved']);

                    // Opsional: Update status aset jadi 'dipinjam' secara otomatis
                    // $record->asset->update([
                    //     'peminjam_terbaru_id' => $record->member_id,
                    //     'sudah_dikembalikan' => false
                    // ]);
                }),

            // TOMBOL REJECT
            Tables\Actions\Action::make('reject')
                ->label('Tolak')
                ->icon('heroicon-m-x-mark')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn (Booking $record) => $record->status === 'pending')
                ->action(fn (Booking $record) => $record->update(['status' => 'rejected'])),

                // Di dalam ->actions([...])

            Tables\Actions\Action::make('pdf') 
                ->label('Cetak Surat')
                ->icon('heroicon-m-printer')
                ->url(fn (Booking $record) => route('booking.print', $record))
                ->openUrlInNewTab()
                ->visible(fn (Booking $record) => $record->status === 'approved'), // Hanya muncul kalau sudah diapprove
        ]);
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
