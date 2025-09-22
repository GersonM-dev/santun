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
use Illuminate\Support\Str;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\ActionGroup;

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
            // ⚡️ Performance & defaults
            ->defaultSort('date', 'desc')
            ->paginated(12)
            ->paginationPageOptions([12, 24, 48])
            ->contentGrid([
                'sm' => 1,
                'md' => 2,
                'xl' => 4,
            ])

            // 🧱 Columns (card style)
            ->columns([
                Stack::make([
                    Tables\Columns\ImageColumn::make('gambar')
                        ->label('Gambar')
                        ->disk('public') // sesuaikan jika bukan "public"
                        ->height(200)
                        ->extraImgAttributes(['loading' => 'lazy', 'alt' => 'Gambar kegiatan'])
                        ->extraAttributes(['class' => 'rounded-lg shadow-lg w-full object-contain']),

                    Panel::make([
                        Tables\Columns\TextColumn::make('name')
                            ->label('Name')
                            ->weight(FontWeight::Bold)
                            ->limit(60)
                            ->tooltip(fn($record) => $record->name)
                            ->alignCenter()
                            ->size('lg')
                            ->searchable(),

                        Tables\Columns\TextColumn::make('date')
                            ->label('Tanggal')
                            ->date('d M Y')
                            ->icon('heroicon-m-calendar')
                            ->badge()
                            ->sortable(),

                        Tables\Columns\TextColumn::make('lokasi')
                            ->label('Lokasi')
                            ->icon('heroicon-m-map-pin')
                            ->toggleable()
                            ->searchable(),

                        // Ringkasan konten yang aman (strip HTML), rapi, dan bisa dibungkus
                        Tables\Columns\TextColumn::make('konten')
                            ->label('Ringkasan')
                            ->formatStateUsing(fn(string $state) => Str::limit(strip_tags($state), 140))
                            ->wrap()
                            ->searchable(),

                        Tables\Columns\TextColumn::make('youtube_video_link')
                            ->label('YouTube')
                            ->state(fn($record) => filled($record->youtube_video_link) ? 'Ada' : '—')
                            ->badge()
                            ->color(fn($state) => $state === 'Ada' ? 'success' : 'gray')
                            ->toggleable(),
                    ])->extraAttributes(['class' => 'mt-4']),
                ]),
            ])

            // 🔎 Filters
            ->filters([
                Filter::make('date_range')
                    ->label('Rentang Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari'),
                        Forms\Components\DatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'] ?? null, fn($q, $date) => $q->whereDate('date', '>=', $date))
                            ->when($data['until'] ?? null, fn($q, $date) => $q->whereDate('date', '<=', $date));
                    }),

                TernaryFilter::make('has_video')
                    ->label('Dengan Video')
                    ->trueLabel('Ada')
                    ->falseLabel('Tidak Ada')
                    ->queries(
                        true: fn(Builder $q) => $q->whereNotNull('youtube_video_link')->where('youtube_video_link', '!=', ''),
                        false: fn(Builder $q) => $q->where(function ($qq) {
                            $qq->whereNull('youtube_video_link')->orWhere('youtube_video_link', '');
                        }),
                        blank: fn(Builder $q) => $q,
                    ),
            ])

            // 🧰 Actions
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->modalHeading('Preview Berita Kegiatan Sosial')
                        ->label('Preview'),

                    Tables\Actions\EditAction::make()
                        ->modalHeading('Edit Berita Kegiatan Sosial'),

                    Tables\Actions\DeleteAction::make()
                        ->modalHeading('Hapus Berita Kegiatan Sosial')
                        ->modalSubheading('Apakah Anda yakin ingin menghapus data ini?')
                        ->modalButton('Hapus'),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])

            // ➕ Header & empty state
            // ->headerActions([
            //     Tables\Actions\CreateAction::make()->label('Tambah Kegiatan'),
            // ])
            ->emptyStateHeading('Belum ada kegiatan')
            ->emptyStateDescription('Tambahkan kegiatan sosial pertama Anda untuk mulai mengisi daftar.')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Tambah Kegiatan'),
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
