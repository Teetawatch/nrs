<?php

namespace App\Filament\Resources\SchoolHistoryResource\Pages;

use App\Filament\Resources\SchoolHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolHistories extends ListRecords
{
    protected static string $resource = SchoolHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
