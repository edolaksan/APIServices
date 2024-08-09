<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $order = Order::create([
            'table_no' => 'MEJA NO 1',
            'total_price' => 47000, // Total dari pesanan contoh di bawah
        ]);

        $productJeruk = Product::where('name', 'Jeruk')->first();
        $productKopi = Product::where('name', 'Kopi')->first();
        $productPromo = Product::where('name', 'Nasi Goreng + Jeruk Dingin (Promo)')->first();
        $productTeh = Product::where('name', 'Teh')->first();
        $productMie = Product::where('name', 'Mie')->first();

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productJeruk->id,
            'variant' => 'dingin',
            'quantity' => 1,
            'price' => 12000,
            'station_printers' => json_encode(['C']),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productKopi->id,
            'variant' => 'panas',
            'quantity' => 1,
            'price' => 6000,
            'station_printers' => json_encode(['C']),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productPromo->id,
            'variant' => 'promo',
            'quantity' => 2,
            'price' => 23000 * 2,
            'station_printers' => json_encode(['B', 'C']),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productTeh->id,
            'variant' => 'manis',
            'quantity' => 1,
            'price' => 8000,
            'station_printers' => json_encode(['C']),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productMie->id,
            'variant' => 'goreng',
            'quantity' => 1,
            'price' => 15000,
            'station_printers' => json_encode(['B']),
        ]);
    }
}
