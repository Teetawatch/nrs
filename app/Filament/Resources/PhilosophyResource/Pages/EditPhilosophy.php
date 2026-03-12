<?php

namespace App\Filament\Resources\PhilosophyResource\Pages;

use App\Filament\Resources\PhilosophyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhilosophy extends EditRecord
{
    protected static string $resource = PhilosophyResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
