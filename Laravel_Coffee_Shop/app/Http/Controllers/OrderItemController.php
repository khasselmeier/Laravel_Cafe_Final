<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    public function destroy(OrderItem $item)
    {
        $this->authorize('update', $item->order);

        $order = $item->order;

        $item->delete();

        // FIXED total calculation
        $order->load('items');
        $order->total_amount = $order->items->sum(function ($i) {
            return $i->quantity * $i->price;
        });
        $order->save();

        return response()->json([
            'success' => true,
            'cartCount' => $order->items->sum('quantity'),
            'message' => 'Item removed from cart!',
        ]);
    }

    public function destroyAll()
    {
        $user = Auth::user();
        $order = $user->orders()->where('status', 'pending')->first();

        if ($order) {
            $order->items()->delete();
            $order->total_amount = 0;
            $order->save();
        }

        return response()->json([
            'success' => true,
            'cartCount' => 0,
            'message' => 'All items removed from cart!',
        ]);
    }
}
