<?php

namespace App\Filament\Resources\ProdukTransaksis\Schemas;

use App\Models\ProdukTransaksi;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProdukTransaksiInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama'),
                TextEntry::make('telepon'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('booking_trx_id'),
                TextEntry::make('kota'),
                TextEntry::make('kode_pos'),
                TextEntry::make('bukti_pembayaran'),
                TextEntry::make('produk_size')
                    ->numeric(),
                TextEntry::make('alamat')
                    ->columnSpanFull(),
                TextEntry::make('kuantitas')
                    ->numeric(),
                TextEntry::make('jumlah_subtotal')
                    ->numeric(),
                TextEntry::make('jumlah_grandtotal')
                    ->numeric(),
                IconEntry::make('is_paid')
                    ->boolean(),
                TextEntry::make('produk.name')
                    ->label('Produk'),
                TextEntry::make('promoCode.id')
                    ->label('Promo code')
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (ProdukTransaksi $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
