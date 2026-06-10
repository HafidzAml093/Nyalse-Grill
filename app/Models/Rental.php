<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'guest_name', 'guest_phone', 'start_date', 'end_date', 'total_price', 'status', 'payment_proof'])]
class Rental extends Model
{
    use HasFactory;

    // Relasi balik ke User (bisa bernilai null jika tamu)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu transaksi penyewaan bisa menyewa banyak alat grill
    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }
}
