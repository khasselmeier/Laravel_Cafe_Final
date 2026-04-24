<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Model::preventLazyLoading();

        View::composer('*', function ($view) {

            $cartCount = 0;

            if (Auth::check()) {
                $order = Auth::user()
                    ->orders()
                    ->where('status', 'pending')
                    ->select('id', 'user_id')
                    ->first();

                if ($order) {
                    $cartCount = \App\Models\OrderItem::where('order_id', $order->id)
                        ->sum('quantity');
                }
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
