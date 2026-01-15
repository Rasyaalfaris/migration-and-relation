<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // TextInput::make('slug')
                //     ->required(),
                FileUpload::make('logo')
                    ->required()
                    ->image()
                    ->directory('Brands'),
            ]);
    }
}
