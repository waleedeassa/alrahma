<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {

    $middleware->prepend(SecurityHeaders::class);
    
    $middleware->redirectGuestsTo(function () {
      if (request()->is('admin/*')) {
        return route('admin.login');
      } elseif (request()->is('sponsor/*')) {
        return route('sponsor.login');
      }
    });

    $middleware->redirectUsersTo(function () {
      if (Auth::guard("web")->check()) {
        return route('admin.dashboard');
      } elseif (Auth::guard("sponsor")->check()) {
        return route('sponsor.dashboard');
      }
    });

    $middleware->alias([
      'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
      'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
      'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
      'checkStatus' => \App\Http\Middleware\CheckAccountStatus::class,
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
