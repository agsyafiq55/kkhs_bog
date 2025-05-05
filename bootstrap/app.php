<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Add your middleware to the global stack
        $middleware->append(
            \App\Http\Middleware\TrustProxies::class,
            \App\Http\Middleware\EnsureLivewireUploadsUsePost::class
        );

        // Update the web middleware group if needed
        $middleware->web(append: [
            // ...
        ]);

        $middleware->alias([
            // ...
        ]);

        // Exclude livewire upload from CSRF verification
        $middleware->skipCsrfToken(['livewire/upload-file']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
