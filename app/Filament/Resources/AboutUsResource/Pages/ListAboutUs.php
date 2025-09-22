<?php

namespace App\Filament\Resources\AboutUsResource\Pages;

use App\Filament\Resources\AboutUsResource;
use App\Models\AboutUs;
use Filament\Resources\Pages\ListRecords;

class ListAboutUs extends ListRecords
{
    protected static string $resource = AboutUsResource::class;

    // Otomatis arahkan ke halaman edit entri tunggal.
    public function mount(): void
    {
        $record = AboutUs::first();

        if (! $record) {
            $record = AboutUs::create([
                'title'   => 'Tentang Kami',
                'visi'    => '',
                'misi'    => '',
                'alamat'  => '',
                'struktur'=> null,
            ]);
        }

        $this->redirect(AboutUsResource::getUrl('edit', ['record' => $record]));
    }

    // Sembunyikan tombol Create pada header.
    protected function getHeaderActions(): array
    {
        return [];
    }
}
