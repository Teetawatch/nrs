<?php

namespace App\Filament\Resources\SchoolSymbolResource\Pages;

use App\Filament\Resources\SchoolSymbolResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolSymbol extends EditRecord
{
    protected static string $resource = SchoolSymbolResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
