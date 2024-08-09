<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'variant', 'quantity', 'price', 'station_printers'];

    // Definisi relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Definisi relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
