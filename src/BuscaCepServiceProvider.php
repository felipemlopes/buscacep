<?php

namespace Faacsilva\BuscaCep;

use Illuminate\Support\ServiceProvider;

class BuscaCepServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {}

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('buscacep', function() {
            return new \Faacsilva\BuscaCep\BuscaCep;
        });
    }
}
