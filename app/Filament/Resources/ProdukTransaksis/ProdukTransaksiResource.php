<?php

namespace App\Filament\Resources\ProdukTransaksis;

use App\Filament\Resources\ProdukTransaksis\Pages\CreateProdukTransaksi;
use App\Filament\Resources\ProdukTransaksis\Pages\EditProdukTransaksi;
use App\Filament\Resources\ProdukTransaksis\Pages\ListProdukTransaksis;
use App\Filament\Resources\ProdukTransaksis\Pages\ViewProdukTransaksi;
use App\Filament\Resources\ProdukTransaksis\Schemas\ProdukTransaksiForm;
use App\Filament\Resources\ProdukTransaksis\Schemas\ProdukTransaksiInfolist;
use App\Filament\Resources\ProdukTransaksis\Tables\ProdukTransaksisTable;
use App\Models\ProdukTransaksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukTransaksiResource extends Resource
{
protected static ?string $navigationLabel = 'Produk Transaksis';
protected static ?string $model = ProdukTransaksi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ProdukTransaksi';

    public static function form(Schema $schema): Schema
    {
        return ProdukTransaksiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProdukTransaksiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProdukTransaksisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProdukTransaksis::route('/'),
            'create' => CreateProdukTransaksi::route('/create'),
            'view' => ViewProdukTransaksi::route('/{record}'),
            'edit' => EditProdukTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
