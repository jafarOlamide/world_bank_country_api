<?php

namespace App\Providers;

use App\Http\Client\WorldBankApiClient;
use Illuminate\Support\ServiceProvider;

class WorldBankApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(WorldBankApiClient::class, function () {
            $client = new WorldBankApiClient();

            $client->baseUrl(config('services.worldBank.baseUrl'));

            return $client;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
