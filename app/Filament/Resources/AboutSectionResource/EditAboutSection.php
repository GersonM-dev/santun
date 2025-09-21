<?php

namespace App\Filament\Resources\AboutSectionResource\Pages;

use App\Filament\Resources\AboutSectionResource;
use Filament\Resources\Pages\EditRecord;

/**
 * Page for editing an existing AboutSection record.
 */
class EditAboutSection extends EditRecord
{
    /**
     * @var string
     */
    protected static string $resource = AboutSectionResource::class;
}