<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PrintReports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-printer';

    protected static ?string $navigationLabel = 'Cetak Laporan';

    protected static ?string $title = 'Cetak Laporan';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 90;

    protected static string $view = 'filament.pages.print-reports';
}

