<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\LaravelPdf\Facades\Pdf;

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
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }
    /**
     * Generate PDF untuk transaksi
     */
    public function generatePdf()
    {
        return Pdf::view('transaksi.pdf', ['transaksi' => $this])
            ->name("transaksi-{$this->booking_trx_id}.pdf");
    }

    /**
     * Generate PDF preview dalam browser
     */
    public function generatePdfPreview()
    {
        return Pdf::view('transaksi.pdf', ['transaksi' => $this])
            ->inline();
    }
    
}