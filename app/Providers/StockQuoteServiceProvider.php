<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\StockApi\StockQuote;

class StockQuoteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StockQuote::class, function ($app) {
            return new StockQuote();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
