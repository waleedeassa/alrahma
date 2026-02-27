<?php

namespace App\Http\Controllers\Sponsor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Auth\AdminLoginRequest;
use App\Http\Requests\Sponsor\Auth\SponsorLoginRequest;

class SponsorLoginController extends Controller
{

  public function check(SponsorLoginRequest $request): RedirectResponse
  {
    // dd($request);
    $request->authenticate();
    $request->session()->regenerate();
    return redirect()->intended(route('sponsor.dashboard'))
    ->with(['message' => 'تم تسجيل الدخول بنجاح', 'type' => 'success']);
  }

}

