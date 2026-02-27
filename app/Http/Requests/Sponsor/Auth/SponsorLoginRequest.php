<?php

namespace App\Http\Requests\Sponsor\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SponsorLoginRequest extends FormRequest
{

  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'email' => ['required', 'email'],
      'password' => ['required'],
    ];
  }

  public function messages()
  {
    return [
      'email.required' => 'البريد الالكترونى مطلوب',
      'email.email' => ' البريد الالكترونى غير صحيح',
      'password.required' => 'كلمة المرور مطلوبه',
    ];
  }

  public function authenticate()
  {
    $this->ensureIsNotRateLimited();

    if (!Auth::guard('sponsor')->attempt($this->only('email', 'password'), $this->boolean('remember'))) {
      RateLimiter::hit($this->throttleKey(),120);

      throw ValidationException::withMessages([
        'email' => 'حدث خطأ ما الرجاء التأكد من البريد الالكترنى وكلمة المرور ',
      ]);
    }

    RateLimiter::clear($this->throttleKey());
  }

  public function ensureIsNotRateLimited()
  {
    if (!RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
      return;
    }

    event(new Lockout($this));

    $seconds = RateLimiter::availableIn($this->throttleKey());

    throw ValidationException::withMessages([
      'email' => trans('auth.throttle', [
        'seconds' => $seconds,
        'minutes' => ceil($seconds / 60),
      ]),
    ]);
  }

  public function throttleKey()
  {
    return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
  }
}
