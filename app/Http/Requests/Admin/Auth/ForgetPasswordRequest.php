<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'email' => "required|email:filter|exists:users,email",
    ];
  }

  public function messages()
  {
    return [
      'email.required' => "البريد الإلكتروني مطلوب",
      'email.email' => "البريد الإلكتروني غير صحيح",
      'email.exists' => "البريد الإلكتروني غير صحيح",
    ];
  }
}
