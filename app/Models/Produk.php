<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Belongsto;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public function setNameAttributes($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function brand(): Belongsto
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function category(): Belongsto
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function photos(): HasMany
    {
        return $this->hasMany(ProdukPhoto::class);
    }
    public function sizes(): HasMany
    {
        return $this->hasMany(ProdukSize::class);
    }
}
