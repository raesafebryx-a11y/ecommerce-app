<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
   public function boot(): void
{
    // Membagikan variabel $cartCount ke semua view/tampilan
    View::composer('*', function ($view) {
        $count = 0;
        if (Auth::check()) {
            // Asumsi: User memiliki relasi 'cart' dan cart memiliki relasi 'items'
            $count = Auth::user()->cart?->items()->count() ?? 0;
        }
        $view->with('cartCount', $count);
    });
}
}
