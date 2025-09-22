<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KegiatanResource\Pages;
use App\Filament\Resources\KegiatanResource\RelationManagers;
use App\Models\Kegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-s-calendar-days';

    protected static ?string $pluralLabel = 'Kegiatan Sosial';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name'),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('Date'),
                Forms\Components\FileUpload::make('gambar')
                    ->required()
                    ->label('Gambar')->columnSpan('full'),
                Forms\Components\RichEditor::make('konten')
                    ->required()
                    ->label('Konten')->columnSpan('full'),
                Forms\Components\TextInput::make('youtube_video_link')
                    ->label('YouTube Video Link')
                    ->nullable(),
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->label('Lokasi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    Tables\Columns\ImageColumn::make('gambar')
                        ->label('Gambar')
                        ->alignCenter()
                        ->width(300)
                        ->height(200)
                        ->columnSpan('full')
                        ->extraAttributes(['class' => 'rounded-lg shadow-lg']),
                    Panel::make([
                        Tables\Columns\TextColumn::make('name')
                            ->label('Name')
                            ->searchable()->weight(FontWeight::Bold)
                            ->alignCenter()->size('lg'),
                        Tables\Columns\TextColumn::make('konten')
                            ->label('Konten')
                            ->limit(length: 100)
                            ->html()
                            ->searchable(),
                    ])->extraAttributes(['class' => 'mt-6']),
                ]),
            ])
            ->paginated(false)
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalHeading('Preview Berita Kegiatan Sosial')->label('Show Details'),
                Tables\Actions\EditAction::make()->modalHeading('Edit Berita Kegiatan Sosial'),
                Tables\Actions\DeleteAction::make()->modalHeading('Hapus Berita Kegiatan Sosial')->modalSubheading('Apakah Anda yakin ingin menghapus data ini?')->modalButton('Hapus'),
            ])
            ->bulkActions([
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
            'index' => Pages\ListKegiatans::route('/'),
        ];
    }
}
