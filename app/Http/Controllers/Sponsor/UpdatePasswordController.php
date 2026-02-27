<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\UpdatePasswordRequest;


class UpdatePasswordController extends Controller
{
  public function index()
  {
    return view('dashboard.update-password.index');
  }

  public function updatePassword(UpdatePasswordRequest $request)
  {
    if (Hash::check($request->old_password, Auth::user()->password)) {

      Auth::user()->update([
        'password' => Hash::make($request->password)
      ]);
      return redirect()->back()
          ->with(['message' => 'تم تغيير كلمة المرور بنجاح', 'type' => 'success']);
    } else {
      return redirect()->back()
        ->with(['message' => 'كلمة المرور الحالية التي أدخلتها غير صحيحة', 'type' => 'error']);
    }
  }
}
