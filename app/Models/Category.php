<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    // 1 Kategori memiliki banyak Produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
