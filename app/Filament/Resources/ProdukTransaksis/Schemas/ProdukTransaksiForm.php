<?php

namespace App\Filament\Resources\ProdukTransaksis\Schemas;

use App\Models\Produk;
use App\Models\PromoCode;
use Filament\Schemas\Schema;
use App\Models\ProdukTransaksi;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

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
                    ->required()
                    ->dehydrated()
                    ->disabled()
                    ->default(function (){
                        return (new ProdukTransaksi())->generateUniqueTrxId();
                    }),
                TextInput::make('kota')
                    ->required(),
                TextInput::make('kode_pos')
                    ->required(),
                FileUpload::make('bukti_pembayaran')
                    ->image()
                    ->directory('BuktiPembayaran')
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
                Toggle::make('is_paid')
                    ->required(),
                Select::make('produk_id')
                    ->options(Produk::pluck('name','id')->toArray())
                    ->required()
                    ->label('Produk')
                    ->searchable(),
                Select::make('promo_code_id')
                    ->label('Promo Code')
                    ->options(PromoCode::pluck('kode','id')->toArray())
                    ->searchable(),
            ]);
    }
}
