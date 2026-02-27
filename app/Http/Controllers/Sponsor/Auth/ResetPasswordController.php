<?php
namespace App\Http\Controllers\Sponsor\Auth;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Sponsor\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
  protected $guard = 'sponsor';
  protected $table = 'sponsors';
  public function showResetPasswordForm(Request $request, $token = null)
  {
    $email = $request->email;
    $token =  $request->token;

    if ($this->checkToken($email, $token)) {
      return view('sponsors.auth.reset-password')->with(['email' => $email, 'token' => $token]);
    } else {
      return redirect()->route('sponsor.login')
        ->with(['message' =>  'رابط إعادة تعيين كلمة المرور غير صحيح', 'type' => 'error']);
    }
  }
  public function checkToken($email, $token)
  {
    $check = DB::table('password_reset_tokens')
      ->where('email', $email)
      ->where('token', $token)
      ->where('guard', $this->guard)
      ->first();
    if (!$check) {
      return false;
    }
    // Check if token is expired ( expiration time is 15 minutes)
    if (Carbon::parse($check->created_at)->addMinutes(config('auth.passwords.sponsors.expire'))->isPast()) {
      return false;
    }
    return $check;
  }
  public function resetPassword(ResetPasswordRequest $request)
  {
    if (!$this->checkToken($request->email, $request->token)) {
      return redirect()->route('sponsor.login')
        ->with(['message' =>  'رابط إعادة تعيين كلمة المرور غير صحيح', 'type' => 'error']);
    }

    try {
      DB::beginTransaction();
      $email = $this->getSponsorEmailByToken($request->token);
      $this->updateSponsorPassword($email, $request->password);
      $this->deleteToken($email);
      DB::commit();
      return redirect()->route('sponsor.login')
        ->with(['message' => 'تم تغيير كلمة المرور بنجاح .  يمكنك الآن تسجيل الدخول', 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->with(['message' => 'عفوا، حدث خطأ', 'type' => 'error']);
    }
  }
  public function getSponsorEmailByToken($token)
  {
    $sponsor = DB::table('password_reset_tokens')
      ->where('token', $token)
      ->where('guard', $this->guard)
      ->first();

    return $sponsor->email;
  }
  public function updateSponsorPassword($email, $password)
  {
    Sponsor::where('email', $email)->update([
      'password' => Hash::make($password)
    ]);
  }
  public function deleteToken($email)
  {
    DB::table('password_reset_tokens')
      ->where('email', $email)
      ->where('guard', $this->guard)
      ->delete();
  }
}
