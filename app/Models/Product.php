<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'price', 'variant'];

    protected $casts = [
        'price' => 'json',
        'variant' => 'json',
    ];

    // Definisi relasi ke OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Metode untuk mendapatkan harga dengan format yang lebih jelas
    public function getPriceAttribute($value)
    {
        return json_decode($value, true);
    }

    // Metode untuk mendapatkan variant dengan format yang lebih jelas
    public function getVariantAttribute($value)
    {
        return json_decode($value, true);
    }
}

