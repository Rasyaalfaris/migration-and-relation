<?php

namespace App\Filament\Resources\ProdukTransaksis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProdukTransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('telepon')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('booking_trx_id')
                    ->required(),
                TextInput::make('kota')
                    ->required(),
                TextInput::make('kode_pos')
                    ->required(),
                TextInput::make('bukti_pembayaran')
                    ->required(),
                TextInput::make('produk_size')
                    ->required()
                    ->numeric(),
                Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('kuantitas')
                    ->required()
                    ->numeric(),
                TextInput::make('jumlah_subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('jumlah_grandtotal')
                    ->required()
                    ->numeric(),
                Toggle::make('is_paid')
                    ->required(),
                Select::make('produk_id')
                    ->relationship('produk', 'name')
                    ->required(),
                Select::make('promo_code_id')
                    ->relationship('promoCode', 'id'),
            ]);
    }
}
