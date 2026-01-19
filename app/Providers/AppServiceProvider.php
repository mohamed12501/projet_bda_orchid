<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS in production and when FORCE_HTTPS env is set
        if (env('FORCE_HTTPS') || env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        
        // Trust Render's proxy headers to recognize HTTPS
        if (env('APP_ENV') === 'production' || env('RENDER')) {
            $this->app['request']->setTrustedProxies(
                ['*'],
                \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT
            );
        }
    }
}
