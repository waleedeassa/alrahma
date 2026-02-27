<?php

namespace App\Http\Controllers\Sponsor\Auth;

use Str;
use Mail;
use Carbon\Carbon;
use App\Mail\RestPassword;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sponsor\Auth\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
  protected $guard = 'sponsor';
  public function showForgetPasswordForm()
  {
    return view('sponsors.auth.forget-password');
  }
  public function sendResetPasswordLink(ForgetPasswordRequest $request)
  {
    try {
      DB::beginTransaction();
      $validatedData = $request->validated();
      $email = $validatedData['email'];
      $token = $this->createToken();
      $this->registerDBToken($email, $token);
      $this->sendResetLinkEmail($token, $email, $request);

      DB::commit();
      return redirect()->back()
        ->with(['message' => __('تم إرسال رابط إعادة تعيين كلمة المرور الى بريدك الإلكتروني بنجاح'), 'type' => 'success']);
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
  }
  public function createToken()
  {
    $token =  hash('sha256', Str::random(120));
    return $token;
  }
  public function registerDBToken($email, $token)
  {
    // Delete existing tokens for this email if they exist
    DB::table('password_reset_tokens')
      ->where('email', $email)
      ->where('guard', $this->guard)
      ->delete();
    DB::table('password_reset_tokens')->insert([
      'email' => $email,
      'token' => $token,
      'guard' => $this->guard,
      'created_at' => Carbon::now(),
    ]);
  }
  public function sendResetLinkEmail($token, $email, $request)
  {
    $actionURL = route('sponsor.reset.password.form', ['token' => $token, 'email' => $email]);
    Mail::to($request->email)->send(new  RestPassword($actionURL));
  }
}
