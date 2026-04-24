<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('is_available', true)->get();
        $categories = $products->groupBy('category');

        $order = null;
        $cartCount = 0;
        if (auth()->check()) {
            $order = auth()->user()
                ->orders()
                ->where('status', 'pending')
                ->with('items.product')
                ->first();
            $cartCount = $order ? $order->items->sum('quantity') : 0;
        }

        $activeTab = $request->query('tab', 'all');

        return view('menu', compact('products', 'categories', 'order', 'activeTab', 'cartCount'));
    }
}
