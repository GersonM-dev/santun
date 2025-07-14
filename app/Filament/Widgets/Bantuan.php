<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Bantuan as BantuanModel;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class Bantuan extends BaseWidget
{
    protected static ?string $heading = 'Pendaftaran Layanan Terbaru';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                BantuanModel::query()
            )
            ->columns([
                TextColumn::make('nama')->label('Nama'),
                TextColumn::make('jenisBantuan.name')->label('Jenis Layanan'),
                TextColumn::make('status')->label('Status'),
            ]);
    }
}
