<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;                   

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
        Vite::prefetch(concurrency: 3);
        Inertia::share('locale', fn () => app()->getLocale());
        Inertia::share('locales', fn () => config('i18n.supported'));

         Inertia::share('auth', fn () => [
            'user' => auth()->user(),
        ]);
    }
}
