<?php

namespace App\Filament\Resources\AboutUsResource\Pages;

use App\Filament\Resources\AboutUsResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditAboutUs extends EditRecord
{
    protected static string $resource = AboutUsResource::class;

    // Hide header actions (e.g., Delete) to enforce single-record mode.
    protected function getHeaderActions(): array
    {
        return [];
    }

    // Explicitly show only a Save button (form action).
    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Simpan')
                ->submit('save'),
        ];
    }
}
