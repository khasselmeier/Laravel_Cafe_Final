<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem; // <- ADD THIS
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add to cart
    public function add(Request $request, Product $product)
    {
        $user = Auth::user();

        // Get or create pending order
        $order = $user->orders()->firstOrCreate(
            ['status' => 'pending'],
            ['total_amount' => 0]
        );

        // Add or update item
        $item = $order->items()->where('product_id', $product->id)->first();
        if ($item) {
            $item->quantity++;
            $item->price = $product->price;
            $item->save();
        } else {
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        // Recalculate total
        $order->total_amount = $order->items->sum(function ($i) {
            return $i->quantity * $i->price;
        });

        $order->save();

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    // Remove single item
    public function remove(OrderItem $item)
    {
        $item->delete();

        // Recalculate total
        $order = $item->order;

        $order->load('items');
        $order->total_amount = $order->items->sum(fn($i) => $i->quantity * $i->price);
        $order->save();        $order->save();

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    // Remove all items
    public function removeAll(Request $request)
    {
        $user = Auth::user();
        $order = $user->orders()->where('status', 'pending')->first();
        if ($order) {
            $order->items()->delete();
            $order->total_amount = 0;
            $order->save();
        }
        return redirect()->back()->with('success', 'All items removed from cart!');
    }
}
