<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
  public function handle(Request $request, Closure $next, string $guard): Response
  {
    if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->status != 1) {
      Auth::guard($guard)->logout();

      $routeName = match ($guard) {
        'web' => 'admin.login',
        'sponsor' => 'sponsor.login',
        default => 'home',
      };
      return redirect()->route($routeName)
        ->with(['message' => 'تم حظر حسابك. يرجى التواصل مع الإدارة', 'type' => 'error']);
    }
    return $next($request);
  }
}
