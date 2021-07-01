<?php

namespace App\Providers;

use App\Models\{
    Seller,
    Sale
};

use App\Observers\{
    SellerObserve,
    SaleObserver
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Seller::observe(SellerObserve::class);
        Sale::observe(SaleObserver::class);
    }
}