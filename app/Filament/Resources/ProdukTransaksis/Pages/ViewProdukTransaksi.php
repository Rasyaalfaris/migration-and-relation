<?php

namespace App\Filament\Resources\ProdukTransaksis\Pages;

use App\Filament\Resources\ProdukTransaksis\ProdukTransaksiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProdukTransaksi extends ViewRecord
{
    protected static string $resource = ProdukTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
