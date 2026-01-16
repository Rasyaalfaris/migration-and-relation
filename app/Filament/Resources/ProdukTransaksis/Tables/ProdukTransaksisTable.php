<?php

namespace App\Filament\Resources\ProdukTransaksis\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class ProdukTransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('telepon')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('booking_trx_id')
                    ->searchable(),
                TextColumn::make('kota')
                    ->searchable(),
                TextColumn::make('kode_pos')
                    ->searchable(),
                ImageColumn::make('bukti_pembayaran')
                    ->circular(),
                TextColumn::make('produk_size')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kuantitas')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jumlah_subtotal')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jumlah_grandtotal')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_paid')
                    ->boolean(),
                TextColumn::make('produk.name')
                    ->searchable(),
                TextColumn::make('promoCode.id')
                    ->searchable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
