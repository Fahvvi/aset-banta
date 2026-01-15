<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BookingResource\Pages;
use App\Filament\Admin\Resources\BookingResource\RelationManagers;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
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
        // 1. URUTKAN DARI YANG TERBARU (Default Sort)
        ->defaultSort('created_at', 'desc') 
        
        ->columns([
            Tables\Columns\TextColumn::make('member.nama')
                ->label('Peminjam')
                ->searchable() // Bisa dicari lewat searchbox global
                ->sortable(),

            Tables\Columns\TextColumn::make('asset.nama_alat')
                ->label('Barang')
                ->searchable(),

            Tables\Columns\TextColumn::make('tanggal_mulai')
                ->label('Mulai')
                ->dateTime('d M Y H:i')
                ->sortable(),

            Tables\Columns\TextColumn::make('tanggal_selesai')
                ->label('Selesai')
                ->dateTime('d M Y H:i')
                ->sortable(),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'approved' => 'success',
                    'rejected' => 'danger',
                    'returned' => 'gray',
                    default => 'gray',
                }),
        ])
        
        // 2. FILTER CANGGIH (Peminjam, Tanggal, Status)
        ->filters([
            // Filter A: Berdasarkan Status
            SelectFilter::make('status')
                ->options([
                    'pending' => 'Pending (Menunggu)',
                    'approved' => 'Approved (Disetujui)',
                    'returned' => 'Returned (Selesai)',
                    'rejected' => 'Rejected (Ditolak)',
                ]),

            // Filter B: Berdasarkan Nama Peminjam (Searchable Dropdown)
            SelectFilter::make('member_id')
                ->label('Filter Peminjam')
                ->relationship('member', 'nama') // Ambil data dari relasi Member
                ->searchable() // Bisa ketik nama
                ->preload(),   // Load data di awal biar cepat

            // Filter C: Berdasarkan Rentang Tanggal (Date Range)
            Filter::make('tanggal')
                ->form([
                    DatePicker::make('dari_tanggal')->label('Dari Tanggal'),
                    DatePicker::make('sampai_tanggal')->label('Sampai Tanggal'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['dari_tanggal'],
                            fn (Builder $query, $date): Builder => $query->whereDate('tanggal_mulai', '>=', $date),
                        )
                        ->when(
                            $data['sampai_tanggal'],
                            fn (Builder $query, $date): Builder => $query->whereDate('tanggal_mulai', '<=', $date),
                        );
                })
        ])
        
        // 3. PAGINATION (Hanya tampil 5 baris di awal)
        ->paginated([5, 10, 25, 50]) 
        
        ->actions([
            // ... (Kode tombol actions Anda yang sebelumnya: Approve, Reject, dll) ...
            // Pastikan Anda copy-paste tombol actions yang sudah kita buat tadi disini
            Tables\Actions\Action::make('approve')
                ->label('Setujui')
                ->icon('heroicon-m-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->action(fn (Booking $record) => $record->update(['status' => 'approved']))
                ->visible(fn (Booking $record) => $record->status === 'pending'),

            Tables\Actions\Action::make('reject')
                ->label('Tolak')
                ->icon('heroicon-m-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn (Booking $record) => $record->update(['status' => 'rejected']))
                ->visible(fn (Booking $record) => $record->status === 'pending'),

            Tables\Actions\Action::make('return')
                ->label('Selesai')
                ->icon('heroicon-m-arrow-left-on-rectangle')
                ->color('gray')
                ->requiresConfirmation()
                ->action(fn (Booking $record) => $record->update(['status' => 'returned']))
                ->visible(fn (Booking $record) => $record->status === 'approved'),

            Tables\Actions\EditAction::make(),
            Tables\Actions\Action::make('cetak')
                ->label('Cetak')
                ->icon('heroicon-m-printer')
                ->url(fn (Booking $record) => route('booking.print', $record))
                ->openUrlInNewTab(),
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
