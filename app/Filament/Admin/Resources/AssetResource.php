<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AssetResource\Pages;
use App\Models\Asset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_alat')->required(),
                Forms\Components\DatePicker::make('tanggal_pembelian')->required(),
                Forms\Components\TextInput::make('harga_beli')->numeric()->prefix('Rp'),
                
                // Pilihan Kategori (Perbaikan di sini)
                Forms\Components\Select::make('kategori')
                    ->label('Kategori Alat')
                    ->options([
                        'tenda' => 'Tenda & Shelter',
                        'carrier' => 'Tas & Carrier',
                        'masak' => 'Alat Masak (Cooking)',
                        'navigasi' => 'Navigasi',
                        'panjat' => 'Alat Panjat (Climbing)',
                        'safety' => 'Safety & P3K',
                        'lainnya' => 'Lainnya (Other)',
                    ])
                    ->required()
                    ->default('lainnya'),

                Forms\Components\Select::make('status_alat')
                    ->options([
                        'Baik' => 'Baik',
                        'Ada Robek' => 'Ada Robek',
                        'Rusak' => 'Rusak',
                    ])->required(),
                
                Forms\Components\TextInput::make('posisi_awal')->required(),
                
                Forms\Components\FileUpload::make('foto_alat')
                    ->image()
                    ->directory('alat'),

                Forms\Components\Section::make('Status Peminjaman (Manual)')
                    ->description('Hanya diisi jika ingin mengubah status secara manual tanpa lewat Booking.')
                    ->schema([
                        Forms\Components\Select::make('peminjam_terbaru_id')
                            ->relationship('member', 'nama')
                            ->searchable()
                            ->preload()
                            ->label('Peminjam Terbaru'),
                        Forms\Components\DateTimePicker::make('waktu_peminjaman'),
                        Forms\Components\Toggle::make('sudah_dikembalikan')
                            ->label('Apakah sudah dikembalikan?')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')->label('No')->sortable(),
            Tables\Columns\ImageColumn::make('foto_alat')->circular(),
            Tables\Columns\TextColumn::make('nama_alat')->searchable()->sortable(),
            
            Tables\Columns\TextColumn::make('kategori')
                ->badge()
                ->color('gray'),

            // LOGIKA BARU: STATUS REAL-TIME
            // Kita cek: Apakah ada activeBooking?
            Tables\Columns\TextColumn::make('status_peminjaman')
                ->label('Status')
                ->badge()
                ->getStateUsing(function (Asset $record) {
                    // Jika ada booking aktif -> Dipinjam
                    if ($record->activeBooking) {
                        return 'Dipinjam';
                    }
                    // Jika kondisi alat rusak -> Rusak
                    if ($record->status_alat === 'Rusak') {
                        return 'Rusak';
                    }
                    // Sisanya -> Tersedia
                    return 'Tersedia';
                })
                ->colors([
                    'danger' => 'Dipinjam',
                    'success' => 'Tersedia',
                    'warning' => 'Rusak',
                ]),

            // LOGIKA BARU: NAMA PEMINJAM
            // Ambil nama dari relasi activeBooking -> member -> nama
            Tables\Columns\TextColumn::make('activeBooking.member.nama')
                ->label('Peminjam Saat Ini')
                ->placeholder('-') // Jika kosong strip
                ->searchable(),

            Tables\Columns\TextColumn::make('posisi_awal')
                ->label('Lokasi / Posisi')
                ->getStateUsing(function ($record) {
                    // Load data peminjam
                    $record->load('activeBooking.member');
                    
                    if ($record->activeBooking) {
                        $member = $record->activeBooking->member;
                        $nama = $member->nama ?? 'Anggota';
                        
                        // Cek kelengkapan alamat
                        // Gabung: Alamat + Desa + Kota
                        $alamat = collect([
                            $member->alamat, 
                            $member->desa, 
                            $member->kota
                        ])->filter()->join(', ');

                        if (!empty($alamat)) {
                            // Jika alamat lengkap: "Jl. Mawar No 5 (Fahmi)"
                            return "{$alamat} ({$nama})";
                        }
                        
                        // Jika alamat kosong, kasih peringatan ke admin
                        return "⚠ ({$nama}) belum set alamat";
                    }

                    // Jika tidak dipinjam, kembali ke lokasi gudang
                    return $record->posisi_awal ?? 'Gudang';
                })
                ->wrap() // Agar teks panjang turun ke bawah
                ->icon(fn ($state) => str_contains($state, 'belum set') ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-map-pin')
                ->color(fn ($state) => str_contains($state, 'belum set') ? 'danger' : 'gray'),
        ])
        ->filters([
            // Filter aset yang sedang dipinjam (Relasi ada isinya)
            Tables\Filters\Filter::make('sedang_dipinjam')
                ->query(fn ($query) => $query->whereHas('activeBooking')),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}