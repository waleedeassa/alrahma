<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    return [
      'name' => 'required|string',
      'family_name' => 'required|string',
      'email' => [
        'required',
        'email:filter',
        Rule::unique('users')->ignore(Auth::id()) 
      ],
      'phone' => 'nullable|string',
      'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ];
  }
  public function messages()
  {
    return [
      'name.required' => ' الاسم مطلوب',
      'name.string' => ' الاسم يجب ان يكون نصا',
      'family_name.required' => 'اسم العائلة مطلوب',
      'family_name.string' => 'اسم العائلة يجب ان يكون نصا',
      'email.required' => 'البريد الالكترونى مطلوب',
      'email.email' => ' البريد الالكترونى غير صحيح',
      'email.unique' => ' البريد الالكترونى موجود مسبقا',
      'phone.string' => ' رقم الهاتف يجب أن يكون رقما',
      'photo.image' => ' الملف المرفق يجب ان يكون صورة',
      'photo.mimes' => ' الملف المرفق يجب ان يكون jpeg,png,jpg',
      'photo.max' => ' الملف المرفق يجب ان يزيد حجمه 2 MB',
    ];
  }
}
