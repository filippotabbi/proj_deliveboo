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
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => '8mwh82p8nbkbbr3n',
                    'publicKey' => 'x6dbvkq39pcqfp2x',
                    'privateKey' => '08f0b13898e9c88f7b5155c5fc1205c2',
                ]
            );
        });
    }
}
