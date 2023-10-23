<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('components.sidebar', function ($view) {
            $sidebarElements = [
                ['text' => 'Dashboard', 'icon' => 'fa-solid fa-house'],
                ['text' => 'Messages', 'icon' => 'fa-solid fa-message'],
                ['text' => 'Mail', 'icon' => 'fa-sharp fa-solid fa-envelope'],
            ];
            $view->with('sidebarElements', $sidebarElements);
        });
    }
}
