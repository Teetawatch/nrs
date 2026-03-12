<?php

namespace App\Filament\Resources\SchoolSystemResource\Pages;

use App\Filament\Resources\SchoolSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolSystem extends EditRecord
{
    protected static string $resource = SchoolSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
