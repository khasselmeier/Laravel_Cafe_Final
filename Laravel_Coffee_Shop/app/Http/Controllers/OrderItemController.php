<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    // Remove a single item from cart
    public function destroy(OrderItem $item)
    {
        $this->authorize('update', $item->order); // optional: ensure user owns the order

        $item->delete();

        // Recalculate order total
        $order = $item->order;
        $order->total_amount = $order->items()->sum(fn($i) => $i->quantity * $i->price);
        $order->save();

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    // Remove all items from the current user's pending order
    public function destroyAll()
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
