<?php


namespace App\Providers;

use App\Traits\DatabaseSeederTrait;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use DatabaseSeederTrait;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        if ($this->isDatabaseEmpty()) {
            $this->seedDatabase();
        }
    }
}
