<?php

namespace App\Filament\Resources\PhilosophyResource\Pages;

use App\Filament\Resources\PhilosophyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhilosophies extends ListRecords
{
    protected static string $resource = PhilosophyResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
