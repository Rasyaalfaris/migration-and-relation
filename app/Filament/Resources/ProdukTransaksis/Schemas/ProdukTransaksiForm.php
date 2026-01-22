<?php

namespace App\Filament\Resources\ProdukTransaksis\Schemas;

use App\Models\Produk;
use App\Models\PromoCode;
use App\Models\ProdukSize;
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
                    Select::make('produk_id')
                    ->options(Produk::pluck('name','id')->toArray())
                    ->required()
                    ->reactive()
                    ->label('Produk')
                    ->searchable()
                    ->afterStateUpdated(fn(callable $set) => $set('produk_size', null)),
                Select::make('produk_size')
                    ->required()
                    ->options(function (callable $get) {
                        $produkId = $get('produk_id');
                        if (! $produkId) {
                                return [];
                            }
                        return ProdukSize::where('produk_id', $produkId)
                    ->pluck('ukuran', 'id');
                    })
                    ->disabled(fn (callable $get) => ! $get('produk_id'))
                    ->reactive(),
                    // Select::make('produk_size')
                    // ->label('Ukuran Produk')
                    // ->required()
                    // ->options(ProdukSize::pluck('ukuran', 'id')->toArray())
                    // ->searchable()
                    // ->disabled(fn (callable $get) => ! $get('produk_id'))
                    // ->reactive(),
                Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('kuantitas')
                    ->required()
                    ->numeric(),
                Toggle::make('is_paid'),
                Select::make('promo_code_id')
                    ->label('Promo Code')
                    ->options(PromoCode::pluck('kode','id')->toArray())
                    ->searchable(),
            ]);
    }
}
