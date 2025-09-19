<?php

namespace App\Filament\Widgets;
use App\Models\Money;
use Illuminate\Support\Carbon;


use Filament\Widgets\ChartWidget;

class DonasiChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penggalangan Donasi';
    protected static ?int $sort = 2;

    public function getColumnSpan(): int | string | array
    {
        return [
            'sm' => 2,
            'md' => 2,
            'lg' => 3,
        ];
    }

    public function getData(): array
    {
        $year = now()->year;
        $labels = [];
        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = Carbon::create()->month($month)->shortMonthName;
            $sum = Money::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->sum('total');
            $data[] = (int) $sum;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Donasi (Rp)',
                    'data' => $data,
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#3b82f6',
                ],
            ],
            'labels' => $labels,
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }
}
