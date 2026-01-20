<?php

namespace App\Filament\Resources\ProdukTransaksis\Pages;

use App\Filament\Resources\ProdukTransaksis\ProdukTransaksiResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Spatie\LaravelPdf\Facades\Pdf;

class ListProdukTransaksis extends ListRecords
{
    protected static string $resource = ProdukTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadAllPdf')
                ->label('Download Semua PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    $transaksis = $this->getFilteredTableQuery()
                        ->with(['produk', 'promocode'])
                        ->get();
                    
                    return Pdf::view('transaksi.all-pdf', [
                        'transaksis' => $transaksis,
                    ])
                    ->name('transaksi_all_' . now()->format('d-m-Y_H-i-s') . '.pdf')
                    ->download();
                }),
            CreateAction::make(),
        ];
    }
}