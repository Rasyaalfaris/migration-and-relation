<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon');
            $table->string('email');
            $table->string('booking_trx_id');
            $table->string('kota');
            $table->string('kode_pos');
            $table->string('bukti_pembayaran');
            $table->unsignedBigInteger('produk_size');
            $table->text('alamat');
            $table->unsignedBigInteger('kuantitas');
            $table->unsignedBigInteger('jumlah_subtotal');
            $table->unsignedBigInteger('jumlah_grandtotal');
            $table->boolean('is_paid');
            $table->foreignId('produk_id')->constrained()->OnDelete('cascade');
            $table->foreignId('promo_code_id')->nullable()->constrained()->nullOnDelete();
            $table->softDeletes();
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_transaksis');
    }
};
