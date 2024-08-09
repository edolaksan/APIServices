<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Jeruk',
            'category_id' => 1, // Kategori Minuman
            'price' => json_encode([
                'dingin' => 12000,
                'panas' => 10000,
            ]),
            'variant' => json_encode(['dingin', 'panas']),
        ]);

        Product::create([
            'name' => 'Teh',
            'category_id' => 1, // Kategori Minuman
            'price' => json_encode([
                'manis' => 8000,
                'tawar' => 5000,
            ]),
            'variant' => json_encode(['manis', 'tawar']),
        ]);

        Product::create([
            'name' => 'Kopi',
            'category_id' => 1, // Kategori Minuman
            'price' => json_encode([
                'dingin' => 8000,
                'panas' => 6000,
            ]),
            'variant' => json_encode(['dingin', 'panas']),
        ]);

        Product::create([
            'name' => 'Mie',
            'category_id' => 2, // Kategori Makanan
            'price' => json_encode([
                'goreng' => 15000,
                'kuah' => 15000,
            ]),
            'variant' => json_encode(['goreng', 'kuah']),
        ]);

        Product::create([
            'name' => 'Nasi Goreng',
            'category_id' => 2, // Kategori Makanan
            'price' => json_encode([
                'nasi_goreng' => 15000,
            ]),
            'variant' => null,
        ]);

        Product::create([
            'name' => 'Nasi Goreng + Jeruk Dingin (Promo)',
            'category_id' => 3, // Kategori Promo
            'price' => json_encode([
                'promo' => 23000,
            ]),
            'variant' => null,
        ]);
        
    }
}
