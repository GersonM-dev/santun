<?php

namespace App\Filament\Resources\AboutUsResource\Pages;

use App\Filament\Resources\AboutUsResource;
use App\Models\AboutUs;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutUs extends CreateRecord
{
    protected static string $resource = AboutUsResource::class;

    // Jika ada entri, jangan izinkan create (redirect ke edit).
    public function mount(): void
    {
        if (AboutUs::query()->exists()) {
            $this->redirect(AboutUsResource::getUrl('index'));
            return;
        }

        parent::mount();
    }
}
