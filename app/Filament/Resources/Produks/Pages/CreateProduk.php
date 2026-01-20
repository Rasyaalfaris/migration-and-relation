<?php

namespace App\Filament\Resources\Produks\Pages;

use App\Models\Produk;
use App\Models\PromoCode;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;
use App\Filament\Resources\Produks\ProdukResource;

class CreateProduk extends CreateRecord
{
    protected static string $resource = ProdukResource::class;
    
    }


