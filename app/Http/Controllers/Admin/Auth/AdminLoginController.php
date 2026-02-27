<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Auth\AdminLoginRequest;

class AdminLoginController extends Controller
{

  public function check(AdminLoginRequest $request): RedirectResponse
  {
    // dd($request);
    $request->authenticate();
    $request->session()->regenerate();
    return redirect()->intended(route('admin.dashboard'))
    ->with(['message' => 'تم تسجيل الدخول بنجاح', 'type' => 'success']);
  }

}

