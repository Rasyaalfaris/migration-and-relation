<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukTransaksi extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukTransaksiFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public function generateUniqueTrxId(){
        $prefix = 'TJH';
        do {
            $randomString = $prefix . mt_rand(10001, 99999);
        } while (self::where('booking_trx_id', $randomString)->exists());
        return $randomString; 
    }
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function promocode() : BelongsTo
    {
        return $this->belongsTo(PromoCode::class, 'promocode_id');
    }
}
