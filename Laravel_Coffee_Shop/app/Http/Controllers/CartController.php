<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
        ]);

        $user = auth()->user();
        $product = Product::findOrFail($productId);

        $order = $user->orders()->firstOrCreate(
            ['status' => 'pending'],
            ['total_amount' => 0]
        );

        $size = $request->input('size', 'small');

        $price = $product->price;

        if ($size === 'medium') $price += 50;
        if ($size === 'large') $price += 100;

        $item = $order->items()
            ->where('product_id', $productId)
            ->where('size', $size)
            ->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $price,
                'size' => $size,
            ]);
        }

        $order->load('items');

        $order->total_amount = $order->items->sum(fn($i) => $i->quantity * $i->price);
        $order->save();

        return response()->json([
            'success' => true,
            'message' => "{$product->name} added to cart",
            'cartCount' => $order->items->sum('quantity'),
        ]);
    }

    public function remove(OrderItem $item, Request $request)
    {
        $order = $item->order;
        $item->delete();

        $order->load('items');
        $order->total_amount = $order->items->sum(fn($i) => $i->quantity * $i->price);
        $order->save();

        return response()->json([
            'success' => true,
            'cartCount' => $order->items->sum('quantity'),
            'message' => 'Item removed from cart'
        ]);
    }

    public function removeAll(Request $request)
    {
        $user = auth()->user();
        $order = $user->orders()->where('status', 'pending')->first();

        if ($order) {
            $order->items()->delete();
            $order->total_amount = 0;
            $order->save();
        }

        return response()->json([
            'success' => true,
            'cartCount' => 0,
            'message' => 'All items removed from cart'
        ]);
    }
}
