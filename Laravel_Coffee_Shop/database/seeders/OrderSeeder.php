<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->get();
        $products = DB::table('products')->get();

        foreach ($users as $user) {

            // Each user gets 1–3 orders
            for ($o = 0; $o < rand(1, 3); $o++) {

                $orderId = DB::table('orders')->insertGetId([
                    'user_id' => $user->id,
                    'total_amount' => 0, // temp
                    'status' => collect(['pending','paid','completed'])->random(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $total = 0;

                // 1–4 items per order
                for ($i = 0; $i < rand(1, 4); $i++) {
                    $product = $products->random();
                    $qty = rand(1, 3);

                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $product->price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $total += $product->price * $qty;
                }

                // Update total
                DB::table('orders')
                    ->where('id', $orderId)
                    ->update(['total_amount' => $total]);

                // Payment
                DB::table('payments')->insert([
                    'order_id' => $orderId,
                    'amount' => $total,
                    'method' => collect(['cash', 'card'])->random(),
                    'status' => 'completed',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
