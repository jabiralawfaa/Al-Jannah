<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/login');
        $middleware->redirectUsersTo(function ($request) {
            $role = $request->user()?->role;
            return match ($role) {
                'sekretaris' => '/sekretaris',
                'bendahara' => '/bendahara',
                'superadmin' => '/superadmin',
                'bendahara' => '/bendahara',
                'ketua' => '/ketua',
                'logistik' => '/logistik',
                'adminweb' => '/adminweb',
                default => '/login',
            };
        });

        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function ($response, $e, $request) {
            $status = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Terjadi kesalahan pada server.',
                ], $status);
            }

            if (view()->exists("errors.{$status}")) {
                return response()->view("errors.{$status}", [], $status);
            }

            return response()->view('errors.500', [], 500);
        });
    })->create();
