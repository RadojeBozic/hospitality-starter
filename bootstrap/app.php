<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SetLocale;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        // Ako budeš koristio API rute, uključi liniju ispod i kreiraj routes/api.php:
        // api: __DIR__ . '/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Alias za naš locale middleware (umesto starog Kernel-a)
        $middleware->alias([
            'set.locale' => SetLocale::class,
        ]);

        // Ako želiš globalni (svakog request-a), otkomentariši:
        // $middleware->append(SetLocale::class);
    })
    ->withExceptions(function ($exceptions) {
        //
    })->create();
