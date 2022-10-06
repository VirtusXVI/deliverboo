<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;


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
        $this->app->singleton(Gateway::class, function($app) {
            return new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'gwbpbfkzyj963v7f',
                'publicKey' => 'znb9wr3b5sn58cty',
                'privateKey' => '4e93fad0d489ba687fedd69190d64a45'
            ]);
        });
    }
}
