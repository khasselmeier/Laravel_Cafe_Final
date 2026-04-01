<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Show cart / checkout page
    public function index()
    {
        $order = Auth::user()
            ->orders()
            ->where('status', 'pending')
            ->with('items.product')
            ->first();

        return view('checkout.index', compact('order'));
    }

    // Show payment screen
    public function payment(Request $request)
    {
        $order = Auth::user()->orders()->where('status', 'pending')->with('items.product')->first();

        if (!$order || !$order->items->count()) {
            return redirect()->route('menu')->with('error', 'Your cart is empty.');
        }

        return view('checkout.payment', compact('order'));
    }

    // Process payment and mark order completed
    public function confirm(Request $request)
    {
        $order = Auth::user()->orders()->where('status', 'pending')->first();

        if (!$order || !$order->items()->count()) {
            return redirect()->route('menu')->with('error', 'Your cart is empty.');
        }

        // Here you would integrate actual payment processing
        $order->status = 'completed';
        $order->save();

        return redirect()->route('checkout.complete');
    }

    // Show confirmation page
    public function complete()
    {
        return view('checkout.complete');
    }
}
