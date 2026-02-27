<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
      return [
        'old_password' => "required|min:8|max:190",
        'password' => "required|confirmed|min:8|max:190"
      ];
    }
  
    public function messages()
    {
      return [
        'old_password.required' => 'كلمة المرور الحالية مطلوبه',
        'old_password.min' => 'كلمة المرور الحالية يجب ألا تقل عن 8 حروف وأرقام',
        'old_password.max' => 'كلمة المرور الحالية يجب ألا تزيد عن 190 حرف ورقام',
        'password.required' =>  'كلمة المرور الجديدة مطلوبه',
        'password.confirmed' => 'كلمة المرور الجديدة غير متطابقة',
        'password.min' => 'كلمة المرور الجديدة يجب ألا تقل عن 8 حروف وأرقام',
        'password.max' => 'كلمة المرور الجديدة يجب ألا تزيد عن 190 حرف ورقام',
      ];
    }
}