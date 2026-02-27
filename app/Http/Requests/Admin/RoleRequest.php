<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {
    return [
      'name' => 'required|string|min:3|max:100|unique:roles,name,' . $this->id,
    ];
  }

  public function messages()
  {
    return [
      'name.required' => ' حقل الاسم مطلوب ',
      'name.string' => ' حقل الاسم يجب أن يكون نصا',
      'name.min' => ' حقل الاسم يجب ألا يقل عن 3 أحرف',
      'name.max' => ' حقل الاسم يجب ألا يزيد عن 100 حرف',
      'name.unique' => 'اسم المسؤول موجود مسبقا',
    ];
  }
}
