<?php

namespace App\Filament\Resources\SchoolSystemResource\Pages;

use App\Filament\Resources\SchoolSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolSystems extends ListRecords
{
    protected static string $resource = SchoolSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
