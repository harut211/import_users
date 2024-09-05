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
        $middleware->validateCsrfTokens(except: [
            'http://127.0.0.1:8000/*',
            'http://localhost/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
//Rachel	Booker	male	23	Manchester	en
//Laura	Grey	female	43	London	en
//Craig	Johnson	male	54	London	ru
//Mary	Jenkins	female	23	Manchester	am
//Jamie	Smith	male	76	Manchester	am
