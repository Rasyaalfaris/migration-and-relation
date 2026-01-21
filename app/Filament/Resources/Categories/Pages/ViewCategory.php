<?php

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CategoryResource;

class ViewCategory extends ViewRecord
{
    protected static string $resource = CategoryResource::class;
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}