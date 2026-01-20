<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;

class ProdukInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('slug'),
                ImageEntry::make('thumbnail'),
                ImageEntry::make('photos')
                    ->label('Gambar Produk')
                    ->getStateUsing(fn ($record) => $record->photos->pluck('photo')->toArray())
                    ->height(100)
                    ->width(100),
                TextEntry::make('about')
                    ->columnSpanFull(),
                IconEntry::make('is_popular')
                    ->boolean(),
                TextEntry::make('price')
                    ->money(),
                TextEntry::make('stock')
                    ->numeric(),
                TextEntry::make('category_id')
                    ->label('kategori'),
                TextEntry::make('brand_id')
                    ->label('brand'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                    TextEntry::make('deleted_at')
                    ->datetime()
                    ->placeholder('-'),
                 RepeatableEntry::make('sizes')
                 ->schema([
                    TextEntry::make('size')
                 ])
            ]);
    }
}
