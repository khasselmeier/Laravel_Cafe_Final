<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $bestSellers = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.image',
                DB::raw('SUM(order_items.quantity) as total_sold')
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.price',
                'products.image'
            )
            ->orderByDesc('total_sold')
            ->limit(4)
            ->get();

        $cartCount = 0;
        if (Auth::check()) {
            $order = Auth::user()->orders()->where('status', 'pending')->with('items')->first();
            $cartCount = $order ? $order->items->sum('quantity') : 0;
        }

        return view('home', compact('bestSellers', 'cartCount'));
    }
}
