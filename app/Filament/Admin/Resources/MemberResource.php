<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// Import komponen untuk gambar
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'Members'; 
    protected static ?string $modelLabel = 'Anggota';
    protected static ?string $pluralModelLabel = 'Anggota'; // Label jamak (biar ga jadi Anggotas)

    public static function form(Form $form): Form
    {
        // DAFTAR ANGKATAN (SESUAI REQUEST)
        $generasiOptions = [
            'Founder' => 'Founder',
            'Perintis Rimba (Pelopor)' => 'Perintis Rimba (Pelopor)',
            'Air Belantara (Perintis)' => 'Air Belantara (Perintis)',
            'Benih Pohon (1)' => 'Benih Pohon (1)',
            'Tunas Muda (2)' => 'Tunas Muda (2)',
            'Jaya Wijaya (3)' => 'Jaya Wijaya (3)',
            'Edelweiss (4)' => 'Edelweiss (4)',
            'Water Source (5)' => 'Water Source (5)',
            'Rafflesia (6)' => 'Rafflesia (6)',
            'Bintang Rimba (7)' => 'Bintang Rimba (7)',
            'Anggota Kehormatan' => 'Anggota Kehormatan',
        ];

        return $form
            ->schema([
                // --- SECTION 1: IDENTITAS ---
                Forms\Components\Section::make('Identitas Anggota')
                    ->schema([
                        Forms\Components\Grid::make(3) // Kita bagi 3 kolom
                            ->schema([
                                // 1. INPUT FOTO (AVATAR)
                                FileUpload::make('avatar')
                                    ->label('Foto Profil')
                                    ->avatar() // Mode bulat
                                    ->directory('member-avatars') // Folder simpan
                                    ->image()
                                    ->imageEditor() // Bisa crop
                                    ->columnSpan(1), // Makan 1 kolom

                                // 2. INPUT NAMA
                                Forms\Components\TextInput::make('nama')
                                    ->required()
                                    ->label('Nama Lengkap')
                                    ->maxLength(255)
                                    ->columnSpan(2) // Makan 2 kolom sisa
                                    ->placeholder('Masukan nama lengkap...'),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nomor_hp')
                                    ->tel()
                                    ->label('Nomor WA / HP')
                                    ->placeholder('0812xxxx'),
                                
                                // DROPDOWN GENERASI
                                Forms\Components\Select::make('generasi')
                                    ->label('Nama Angkatan')
                                    ->options($generasiOptions)
                                    ->searchable() 
                                    ->required(),
                            ]),

                        Forms\Components\Select::make('status')
                            ->options([
                                'Aktif' => 'Aktif',
                                'Tidak Aktif' => 'Tidak Aktif',
                                'Alumni' => 'Alumni',
                            ])
                            ->default('Aktif')
                            ->required(),
                    ]),

                // --- SECTION 2: DOMISILI ---
                Forms\Components\Section::make('Domisili')
                    ->schema([
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat Jalan / RT / RW')
                            ->rows(2)
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('desa')->label('Desa / Kelurahan'),
                                Forms\Components\TextInput::make('kota')->label('Kota / Kabupaten'),
                                Forms\Components\TextInput::make('kode_pos')->label('Kode Pos')->numeric(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TAMPILKAN FOTO DI TABEL
                ImageColumn::make('avatar')
                    ->label('')
                    ->circular(),

                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('generasi')
                    ->label('Angkatan')
                    ->sortable()
                    ->badge() 
                    ->color('warning'),
                
                Tables\Columns\TextColumn::make('nomor_hp')
                    ->label('Kontak')
                    ->icon('heroicon-m-phone'),

                Tables\Columns\TextColumn::make('kota')
                    ->label('Domisili')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Alumni' => 'info',
                        'Tidak Aktif' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                // FILTER 1: STATUS
                SelectFilter::make('status')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Alumni' => 'Alumni',
                        'Tidak Aktif' => 'Tidak Aktif',
                    ]),

                // FILTER 2: ANGKATAN (BARU)
                SelectFilter::make('generasi')
                    ->label('Filter Angkatan')
                    ->searchable() // Agar mudah dicari jika listnya panjang
                    ->options([
                        'Founder' => 'Founder',
                        'Perintis Rimba (Pelopor)' => 'Perintis Rimba (Pelopor)',
                        'Air Belantara (Perintis)' => 'Air Belantara (Perintis)',
                        'Benih Pohon (1)' => 'Benih Pohon (1)',
                        'Tunas Muda (2)' => 'Tunas Muda (2)',
                        'Jaya Wijaya (3)' => 'Jaya Wijaya (3)',
                        'Edelweiss (4)' => 'Edelweiss (4)',
                        'Water Source (5)' => 'Water Source (5)',
                        'Rafflesia (6)' => 'Rafflesia (6)',
                        'Bintang Rimba (7)' => 'Bintang Rimba (7)',
                        'Anggota Kehormatan' => 'Anggota Kehormatan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}