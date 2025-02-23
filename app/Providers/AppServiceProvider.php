<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DatabaseSeederService;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DatabaseSeederService::class, function ($app) {
            return new DatabaseSeederService(
                $app->make(\App\Services\JsonFileReader::class),
                $app->make(\App\Services\DataTransformer::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $seeder = app(DatabaseSeederService::class);

        if ($seeder->isDatabaseEmpty()) {
            $seeder->seedDatabase();
        }
    }
}
