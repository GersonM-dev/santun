<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bantuan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BantuanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BantuanResource\RelationManagers;

class BantuanResource extends Resource
{
    protected static ?string $model = Bantuan::class;

    protected static ?string $navigationIcon = 'heroicon-s-lifebuoy';

    protected static ?string $pluralLabel = 'Pendaftaran Layanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->label('Nama')->required(),
                DatePicker::make('date_birth')->label('Tanggal Lahir')->required()->afterStateUpdated(function ($state, callable $set) {
                    $set('tanggal', $state);
                }),
                Select::make('id_jenisBantuan')
                    ->label('Jenis Layanan')
                    ->relationship('jenisbantuan', 'name')
                    ->required(),
                TextInput::make('kontak')->label('Kontak')->required(),

                Textarea::make('keluhan')->label('Keluhan')->required()->columnSpanFull(),
                Textarea::make('alamat')->label('Alamat')->required()->columnSpanFull(),
                TextInput::make('status')
                    ->label('Status')
                    ->default('belum diproses')
                    ->hidden(),
                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->default(now())
                    ->required()
                    ->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('Nama')->searchable(),
                TextColumn::make('jenisbantuan.name')->label('Jenis Layanan')->searchable(),
                TextColumn::make('date_birth')->label('Tanggal Lahir')->date()->searchable(),
                TextColumn::make('kontak')->label('Kontak')->searchable(),
                SelectColumn::make('status')
                    ->options([
                        'proses' => 'Proses',
                        'belum diproses' => 'Belum Diproses',
                        'selesai' => 'Selesai',
                    ])
            ])
            ->filters([
                SelectFilter::make('id_jenisBantuan')
                    ->label('Jenis Layanan')
                    ->relationship('jenisbantuan', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListBantuans::route('/'),
            // 'create' => Pages\CreateBantuan::route('/create'),
            // 'view' => Pages\ViewBantuan::route('/{record}'),
            // 'edit' => Pages\EditBantuan::route('/{record}/edit'),
        ];
    }
}
