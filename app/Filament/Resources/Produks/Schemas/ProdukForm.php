<?php

namespace App\Filament\Resources\Produks\Schemas;

use App\Models\Brand;
use App\Models\Category;
use Filament\Schemas\Schema;
use function Laravel\Prompts\search;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                FileUpload::make('thumbnail')
                    ->required()
                    ->image()
                    ->directory('Produks'),
                Textarea::make('about')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_popular')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                Select::make('category_id')
                    ->required()
                    ->label('Category')
                    ->options(Category::pluck('nama', 'id')->toArray())
                    ->searchable(),
                Select::make('brand_id')
                    ->required()
                    ->label('Brand')
                    ->options(Brand::pluck('name', 'id')->toArray())
                    ->searchable(),
            ]);
    }
}
