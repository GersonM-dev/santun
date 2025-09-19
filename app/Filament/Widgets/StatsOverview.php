<?php

namespace App\Filament\Widgets;
use App\Models\Bantuan;
use App\Models\Money;
use App\Models\User;


use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected static ?int $sort = 1;
    protected function getStats(): array
    {

        $totalPendaftaran = Bantuan::count();
        $totalDonasi = Money::sum('total');
        $totalUser = User::count();

        return [
            Stat::make('Jumlah Pendaftaran', $totalPendaftaran . ' pendaftar')
                ->description('Dihitung dari seluruh entri Bantuan')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Donasi', 'Rp ' . number_format($totalDonasi, 0, ',', '.'))
                ->description('Total donasi uang yang diterima')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Jumlah User', $totalUser . ' orang')
                ->description('Total pengguna terdaftar')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }

}
