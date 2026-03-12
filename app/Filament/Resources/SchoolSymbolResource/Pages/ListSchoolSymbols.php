<?php

namespace App\Filament\Resources\SchoolSymbolResource\Pages;

use App\Filament\Resources\SchoolSymbolResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolSymbols extends ListRecords
{
    protected static string $resource = SchoolSymbolResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
