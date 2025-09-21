<?php

namespace App\Filament\Resources\AboutSectionResource\Pages;

use App\Filament\Resources\AboutSectionResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Page for creating a new AboutSection record.
 */
class CreateAboutSection extends CreateRecord
{
    /**
     * @var string
     */
    protected static string $resource = AboutSectionResource::class;
}