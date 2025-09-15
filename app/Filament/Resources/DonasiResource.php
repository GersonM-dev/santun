<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Tables;
use App\Models\Donasi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DonasiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DonasiResource\RelationManagers;
use App\Filament\Resources\DonasiResource\RelationManagers\ItemRelationManager;
use App\Filament\Resources\DonasiResource\RelationManagers\MoneyRelationManager;
use Filament\Tables\Actions\Action;

class DonasiResource extends Resource
{
    protected static ?string $model = Donasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Penggalangan Donasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Donatur')
                    ->required(),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->required(),
                DatePicker::make('date')
                    ->label('Tanggal Donasi')
                    ->date()
                    ->required(),
                Select::make('type')
                    ->label('Tipe Donasi')
                    ->options([
                        'Materi' => 'Materi',
                        'Non Materi' => 'Non Materi',
                    ])
                    ->required()
                    ->reactive(),
                Select::make('tujuan_donasi_id')
                    ->label('Tujuan Donasi')
                    ->relationship('tujuanDonasi', 'name')
                    ->required(),
                RichEditor::make('catatan')
                    ->label('Catatan Donatur')
                    ->nullable(),
                Toggle::make('is_anonymous')
                    ->label('Donasi Anonim')
                    ->default(false)
                    ->inline(false)
                    ->required(),

                Repeater::make('money')
                    ->relationship('money')
                    ->schema([
                        TextInput::make('total')->numeric()->required(),
                        FileUpload::make('proof_picture')->image(),
                    ])
                    ->label('Uang')->maxItems(1)->columnSpanFull()
                    ->visible(fn($get) => $get('type') === 'Materi'),

                Repeater::make('items')
                    ->relationship('items')
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('qty')->numeric()->required(),
                        Select::make('satuan_id')
                            ->options(\App\Models\Satuan::pluck('name', 'id'))
                            ->required(),
                    ])
                    ->label('Barang')->maxItems(1)->columnSpanFull()
                    ->visible(fn($get) => $get('type') === 'Non Materi'),

                Repeater::make('jasa')
                    ->relationship('jasa')
                    ->schema([
                        RichEditor::make('description_jasa')->required(),
                        FileUpload::make('jasa_attachment')->image(),
                    ])
                    ->label('Jasa')->maxItems(1)->columnSpanFull()
                    ->visible(fn($get) => $get('type') === 'Non Materi'),

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Donatur')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Nomor Telepon'),
                Tables\Columns\TextColumn::make('date')->label('Tanggal Donasi')->date(),
                Tables\Columns\BadgeColumn::make('type')->label('Tipe Donasi'),
                Tables\Columns\TextColumn::make('tujuanDonasi.name')->label('Tujuan Donasi'),

                Tables\Columns\IconColumn::make('is_anonymous')
                    ->label('Anonim')
                    ->boolean(),

                Tables\Columns\TextColumn::make('items_summary')
                    ->label('Barang Donasi')
                    ->getStateUsing(function ($record) {
                        if ($record->type === 'Materi') {
                            return $record->items->map(function ($item) {
                                return $item->name . ' (' . $item->qty . ' ' . optional($item->satuan)->name . ')';
                            })->join(', ');
                        }
                        return '-';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('money_summary')
                    ->label('Donasi Uang')
                    ->getStateUsing(function ($record) {
                        if ($record->type === 'Non Materi' && $record->money) {
                            return 'Rp ' . number_format($record->money->total, 0, ',', '.');
                        }
                        return '-';
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('download_pdf')
        ->label('Download PDF')
        ->icon('heroicon-o-arrow-down-tray')
        ->url(fn ($record) => route('donasi.pdf', ['record' => $record]))
        ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonasis::route('/'),
            // 'create' => Pages\CreateDonasi::route('/create'),
            // 'edit' => Pages\EditDonasi::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            MoneyRelationManager::class,
            ItemRelationManager::class,
        ];
    }

}
