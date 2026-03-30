<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fake product data (replace with DB later)
        $products = [
            ['name' => 'Coffee Moka', 'price' => 23],
            ['name' => 'Coffee Latte', 'price' => 23],
            ['name' => 'Black Coffee', 'price' => 23],
            ['name' => 'Cappuccino', 'price' => 23],
        ];

        return view('home', compact('products'));
    }
}
