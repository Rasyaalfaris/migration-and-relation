<?php

namespace App\Filament\Resources\ProdukTransaksis\Pages;

use App\Models\Produk;
use App\Models\PromoCode;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use App\Filament\Resources\ProdukTransaksis\ProdukTransaksiResource;

class CreateProdukTransaksi extends CreateRecord
{
    protected static string $resource = ProdukTransaksiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $produk = Produk::find($data["produk_id"]);
        $harga = $produk->price * $data['kuantitas'];

        $produk = Produk::findOrFail($data['produk_id']);
        if($produk->stock <= 0){
            throw ValidationException::withMessages([
                'produk_id' => 'Stok produk tidak mencukupi.',
            ]);
        }
        if ($produk->stock < $data['kuantitas']) {
            throw ValidationException::withMessages([
                'kuantitas' => 'melebihi stok yang ada (stok: '. $produk->stock . ' items).',
            ]);
        }
        $harga = $produk->price * $data['kuantitas'];
        $grandTotal = $harga;

        if (!empty($data['promo_code_id'])) {
            $promo = PromoCode::find($data['promo_code_id']);
            $grandTotal = $harga - $promo->jumlah_diskon;
        }

        $data['booking_trx_id'] = "TJH" . mt_rand(10001, 99999);
        $produk->stock -= $data['kuantitas'];
        $produk->save();
        $data['jumlah_subtotal'] = $harga;
        $data['jumlah_grandtotal'] = $grandTotal;

        return $data;
    }
}
