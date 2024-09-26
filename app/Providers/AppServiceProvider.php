<?php

namespace App\Providers;

use App\Services\LeadBookTicketProvider;
use App\Services\TicketProviderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TicketProviderInterface::class, LeadBookTicketProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
