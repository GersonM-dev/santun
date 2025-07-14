<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Donasi as DonasiModel;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class Donasi extends BaseWidget
{
    protected static ?string $heading = 'Pendaftaran Donasi Terbaru';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                DonasiModel::query()
            )
            ->columns([
                TextColumn::make('name')->label('Nama'),
                TextColumn::make('phone')->label('Nomor Telepon'),
                TextColumn::make('type')->label('Jenis Donasi'),
            ]);
    }
}
