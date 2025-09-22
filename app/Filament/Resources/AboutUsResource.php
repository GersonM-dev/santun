<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Models\AboutUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'Tentang Kami';
    protected static ?string $modelLabel = 'Tentang Kami';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(150)
                            ->placeholder('Tentang Kami'),

                        Forms\Components\TextInput::make('alamat')
                            ->label('Link Google Maps')
                            ->url()
                            ->placeholder('https://maps.google.com/...')
                            ->helperText('Tempelkan URL Google Maps lokasi Anda'),
                    ]),

                Forms\Components\Section::make('Struktur Organisasi')
                    ->schema([
                        Forms\Components\FileUpload::make('struktur')
                            ->label('Gambar Struktur')
                            ->image()
                            ->directory('about-us/struktur')
                            ->imageEditor()
                            ->maxSize(4096)
                            ->helperText('Unggah gambar struktur (PNG/JPG, maks 4 MB).'),
                    ]),

                Forms\Components\Section::make('Konten')
                    ->columns(2)
                    ->schema([
                        Forms\Components\RichEditor::make('visi')
                            ->label('Visi')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3', 'bulletList', 'orderedList', 'link',
                            ])
                            ->columnSpanFull()
                            ->required(),

                        Forms\Components\RichEditor::make('misi')
                            ->label('Misi')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3', 'bulletList', 'orderedList', 'link',
                            ])
                            ->columnSpanFull()
                            ->required()
                            ->helperText('Anda bisa menulis poin misi sebagai bullet list.'),
                    ]),
            ]);
    }

    // Tidak perlu tabel, karena hanya satu entri & kita redirect dari List ke Edit.
    public static function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->filters([])
            ->actions([])         // sembunyikan aksi baris
            ->bulkActions([]);    // sembunyikan bulk actions
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAboutUs::route('/'),
            // create tidak akan dipakai (disembunyikan di List), tapi boleh dibiarkan
            'create' => Pages\CreateAboutUs::route('/create'),
            'edit'   => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }
}
