<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukPhoto extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukPhotoFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
}
