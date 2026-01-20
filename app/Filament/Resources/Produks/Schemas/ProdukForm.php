<?php

namespace App\Filament\Resources\Produks\Schemas;

use App\Models\Brand;
use App\Models\Category;
use Filament\Schemas\Schema;
use function Laravel\Prompts\search;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\Factories\Relationship;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                FileUpload::make('thumbnail')
                    ->label('thumbnail')
                    ->required( )
                    ->image()
                    ->directory('Produks'),
                    Repeater::make('images')
                    ->relationship('photos')
                    ->schema([
                        FileUpload::make('photo')
                        ->image()
                        ->directory('photo_produk')
                        ->nullable()
                        ->disk('public')
                    ])->addActionLabel('Tambah Gambar Produk')
                    ->defaultItems(0),
                Textarea::make('about')
                    ->label('tentang')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_popular')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('IDR')
                    ->currencyMask(),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                Select::make('category_id')
                    ->required()
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable(),
                Select::make('brand_id')
                    ->required()
                    ->label('Brand')
                    ->options(Brand::pluck('name', 'id')->toArray())
                    ->searchable(),
                    Repeater::make('sizes')
                    ->relationship('sizes')
                    ->schema([
                        TextInput::make('size')
                    ])
            ]);
    }
}
