<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Laptop',
                'description' => 'High-performance laptop',
                'price' => 1000,
                'stock_quantity' => 10,
            ],
            [
                'id' => 2,
                'name' => 'Smartphone',
                'description' => 'Latest model smartphone',
                'price' => 800,
                'stock_quantity' => 15,
            ],
            [
                'id' => 3,
                'name' => 'Headphones',
                'description' => 'Noise-cancelling headphones',
                'price' => 200,
                'stock_quantity' => 50,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['id' => $product['id']], $product);
        }
    }
}
