<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PayseraServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleron(PayseraService::class, function ($app){
            $paysera = new PayseraService([
                'projectid'     => 191183,
                'sign_password' => 'dc1c347d471f68e41ad2a9a1145941d6',
            ]);
            return $paysera;
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
