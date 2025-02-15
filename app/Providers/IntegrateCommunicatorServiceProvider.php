<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IntegrateCommunicatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        foreach (config('integrate.providers') as $deliveryMethod => $config) {
            $this->app->bind($deliveryMethod, function () use ($deliveryMethod) {
                return app()->make(config('integrate.providers.' . $deliveryMethod . '.service'));
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
