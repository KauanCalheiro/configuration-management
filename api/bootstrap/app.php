<?php

use App\Http\Middleware\RequestLogger;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/thorn-api/up',
        apiPrefix: 'thorn-api'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(RequestLogger::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
