<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLogoutController extends Controller
{
  public function logout(Request $request)
  {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login')
    ->with(['message' => 'تم تسجيل الخروج بنجاح', 'type' => 'success']);
  }
}
