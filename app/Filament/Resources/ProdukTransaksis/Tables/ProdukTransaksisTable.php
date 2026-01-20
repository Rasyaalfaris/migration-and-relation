<?php

namespace App\Filament\Resources\ProdukTransaksis\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Models\ProdukTransaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\BulkAction;
use Filament\Actions\ActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\Collection;

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
                TextColumn::make('promocode.kode')
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
            ->actions([
                ActionGroup::make([
                    Action::make('downloadPdf')
                        ->label('Download PDF')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (ProdukTransaksi $record) {
                            $transaksi = $record->load(['produk', 'promocode']);
                            
                            $html = view('transaksi.pdf', [
                                'transaksi' => $transaksi,
                            ])->render();
                            
                            $html = iconv('UTF-8', 'ISO-8859-1//IGNORE', $html);
                            
                            $pdf = Pdf::loadHTML($html);
                            $filename = 'transaksi_' . $record->booking_trx_id . '.pdf';
                            return $pdf->download($filename);
                        }),
                ])->button(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('downloadPdf')
                        ->label('Download PDF')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (Collection $records) {
                            $transaksis = $records->load(['produk', 'promocode']);
                            
                            $html = view('transaksi.all-pdf', [
                                'transaksis' => $transaksis,
                            ])->render();
                            
                            $html = iconv('UTF-8', 'ISO-8859-1//IGNORE', $html);
                            
                            $pdf = Pdf::loadHTML($html);
                            $filename = 'Laporan_' . now()->format('d-m-Y_H-i-s') . '.pdf';
                            return $pdf->download($filename);
                        }),
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ])
            ->filters([
                TrashedFilter::make(),
            ]);
    }
}