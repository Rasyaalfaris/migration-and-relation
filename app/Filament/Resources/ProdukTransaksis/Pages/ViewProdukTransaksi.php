<?php

namespace App\Filament\Resources\ProdukTransaksis\Pages;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ProdukTransaksis\ProdukTransaksiResource;

class ViewProdukTransaksi extends ViewRecord
{
    protected static string $resource = ProdukTransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewPdf')
                ->label('Preview PDF')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(fn ($record) => route('preview_transaksi.pdf', $record->id)),
                    
            Action::make('downloadPdf')
                ->label('Download PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(fn ($record) => route('transaksi.pdf', $record->id)),
            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}