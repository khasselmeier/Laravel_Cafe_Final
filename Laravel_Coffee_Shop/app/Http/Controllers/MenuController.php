<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show all products grouped by category for the menu page
     */
    public function index(Request $request)
    {
        $products = Product::where('is_available', true)->get();
        $categories = $products->groupBy('category');

        $order = null;
        if (auth()->check()) {
            $order = auth()->user()
                ->orders()
                ->where('status', 'pending')
                ->with('items.product')
                ->first();
        }

        $activeTab = $request->query('tab', 'all');

        return view('menu', compact('products', 'categories', 'order', 'activeTab'));
    }
}
