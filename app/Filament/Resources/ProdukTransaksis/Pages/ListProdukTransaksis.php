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
            CreateAction::make(),
        ];
    }
}