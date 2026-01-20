<?php

namespace App\Filament\Resources\ProdukTransaksis\Pages;

use App\Filament\Resources\ProdukTransaksis\ProdukTransaksiResource;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

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
                ->action(function () {
                    return $this->record->generatePdfPreview();
                }),
            Action::make('downloadPdf')
                ->label('Download PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    return $this->record->generatePdf()->download();
                }),
            EditAction::make(),
        ];
    }
}