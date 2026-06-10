<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['rental_id', 'product_id', 'quantity', 'price_at_rent'])]
class RentalItem extends Model
{
    use HasFactory;

    // Milik transaksi yang mana?
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    // Alat grill apa yang disewa?
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
