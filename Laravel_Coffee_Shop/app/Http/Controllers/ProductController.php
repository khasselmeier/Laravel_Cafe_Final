<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show all products (menu page)
     */
    public function index()
    {
        // Only fetch available products as models
        $products = Product::where('is_available', true)->get();

        // Group products by category
        $categories = $products->groupBy('category');

        return view('menu', compact('products', 'categories'));
    }

    /**
     * Show single product page
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
