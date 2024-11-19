
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // ...existing code...
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Session::extend('database', function ($app) {
            return new \Illuminate\Session\DatabaseSessionHandler(
                $app['db']->connection(),
                $app['config']['session.table'],
                $app['config']['session.lifetime'],
                $app
            );
        });
    }
}