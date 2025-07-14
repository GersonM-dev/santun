<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pendaftaran Layanan', '10 orang')
                ->description('Meningkat 5% dari bulan lalu')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Donasi', 'Rp 2.000.000')
                ->description('meningkat 7% dari bulan lalu')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Jumlah User', '20 orang')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
