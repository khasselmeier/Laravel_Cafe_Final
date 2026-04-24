<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Coffee
            ['name' => 'Hot Coffee', 'category' => 'coffee', 'price' => 300],
            ['name' => 'Iced Coffee', 'category' => 'coffee', 'price' => 350],
            ['name' => 'Latte', 'category' => 'coffee', 'price' => 450],
            ['name' => 'Cappuccino', 'category' => 'coffee', 'price' => 450],
            ['name' => 'Espresso', 'category' => 'coffee', 'price' => 250],

            // Tea
            ['name' => 'Hot Tea', 'category' => 'tea', 'price' => 250],
            ['name' => 'Iced Tea', 'category' => 'tea', 'price' => 300],
            ['name' => 'Green Tea', 'category' => 'tea', 'price' => 275],

            // Pastries
            ['name' => 'Croissant', 'category' => 'pastry', 'price' => 325],
            ['name' => 'Muffin', 'category' => 'pastry', 'price' => 300],
            ['name' => 'Bagel', 'category' => 'pastry', 'price' => 275],

            // Hot Food
            ['name' => 'Breakfast Sandwich', 'category' => 'hot_food', 'price' => 650],
            ['name' => 'Panini', 'category' => 'hot_food', 'price' => 750],

            // Cold Food
            ['name' => 'Salad', 'category' => 'cold_food', 'price' => 600],
            ['name' => 'Yogurt Parfait', 'category' => 'cold_food', 'price' => 500],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'category' => $product['category'],
                'price' => $product['price'],
                'description' => null,
                'image' => 'images/' . strtolower(str_replace(' ', '_', $product['name'])) . '.jpg',                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
