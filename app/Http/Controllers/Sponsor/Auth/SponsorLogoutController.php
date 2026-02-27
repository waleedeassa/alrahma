<?php

namespace App\Http\Controllers\Sponsor\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SponsorLogoutController extends Controller
{
  public function logout(Request $request)
  {
    Auth::guard('sponsor')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('sponsor.login')
    ->with(['message' => 'تم تسجيل الخروج بنجاح', 'type' => 'success']);
  }
}
