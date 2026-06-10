<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
        'category_id', // TAMBAHKAN INI AGAR BISA MENYIMPAN RELASI KATEGORI
    ];

    // Relasi One-to-Many (Produk ini milik 1 Kategori)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi Many-to-Many (Produk ini punya banyak Tag)
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
