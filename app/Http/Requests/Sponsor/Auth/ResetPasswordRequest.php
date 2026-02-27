<?php

namespace App\Http\Requests\Sponsor\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'token' => 'required',
      'email' => "required|email:filter|exists:sponsors,email",
      'password' => 'required|string|min:8|confirmed',
      'password_confirmation' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'email.required' => "البريد الإلكتروني مطلوب",
      'email.email' => "البريد الإلكتروني غير صحيح",
      'email.exists' => "البريد الإلكتروني غير صحيح",
      'password.required' => "كلمة المرور مطلوبة",
      'password.min' => 'كلمة المرور الجديدة يجب ألا تقل عن 8 حروف وأرقام',
      'password.confirmed' => "كلمة المرور وتأكيدها غير متطابقين",
    ];
  }
}
