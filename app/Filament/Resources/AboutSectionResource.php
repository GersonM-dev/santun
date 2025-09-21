<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutSectionResource\Pages;
use App\Models\AboutSection;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

/**
 * Filament Resource definition for the AboutSection model.
 *
 * This resource exposes a CRUD interface in the Filament admin panel,
 * allowing administrators to create, edit and reorder sections of the
 * “Tentang Kami” page. Each section has a unique key, a title and
 * rich text content. The list table defaults to sorting by the
 * `order` column so that sections appear in the correct order on
 * the public site.
 */
class AboutSectionResource extends Resource
{
    /**
     * The underlying model that this resource manages.
     *
     * @var string|null
     */
    protected static ?string $model = AboutSection::class;

    /**
     * The icon used for the resource navigation menu item.
     * You can choose any Heroicon or your own custom SVG here.
     *
     * @var string|null
     */
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    /**
     * Customize the navigation label and grouping so the resource
     * appears under a logical section in the admin panel.
     *
     * @var string|null
     */
    protected static ?string $navigationLabel = 'Tentang Kami';
    protected static ?string $navigationGroup = 'Konten';

    /**
     * Optionally override the route slug used in the URL. This slug
     * becomes part of the admin URL, for example `/admin/tentang-kami`.
     *
     * @var string|null
     */
    protected static ?string $slug = 'tentang-kami';

    /**
     * Define the form fields used for creating and editing records.
     *
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Kunci')
                            ->helperText('Gunakan format unik seperti our_advantage_title')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Menentukan urutan tampilan (angka lebih kecil tampil lebih dulu).'),
                    ]),
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('content')
                    ->label('Konten')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    /**
     * Define the table used for listing records.
     *
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Kunci')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('order');
    }

    /**
     * There are no relationships defined for this resource.
     *
     * @return array
     */
    public static function getRelations(): array
    {
        return [];
    }

    /**
     * Map the resource pages to their routes. Filament will
     * automatically prefix these with the resource slug.
     *
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutSections::route('/'),
            'create' => Pages\CreateAboutSection::route('/create'),
            'edit' => Pages\EditAboutSection::route('/{record}/edit'),
        ];
    }
}