<?php

namespace App\Filament\Resources\AboutSectionResource\Pages;

use App\Filament\Resources\AboutSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * Page for listing AboutSection records.
 *
 * Displays a table of all sections and provides an action to create new
 * sections. The default sort order is defined in the resource itself.
 */
class ListAboutSections extends ListRecords
{
    /**
     * @var string
     */
    protected static string $resource = AboutSectionResource::class;

    /**
     * Configure available header actions for the list page. Here we
     * enable the create button.
     *
     * @return array
     */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}