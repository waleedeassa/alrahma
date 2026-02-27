<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{


  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {
    return [
      'name' => 'required|string|min:3|max:100|unique:permissions,name,' . $this->id,
      'group_name' => 'required|string'
    ];
  }

  public function messages()
  {
    return [
      'name.required' => ' حقل الاسم مطلوب ',
      'name.string' => ' حقل الاسم يجب أن يكون نصا',
      'name.min' => ' حقل الاسم يجب ألا يقل عن 3 أحرف',
      'name.max' => ' حقل الاسم يجب ألا يزيد عن 100 حرف',
      'name.unique' => 'اسم الصلاحية موجود مسبقا',
      'group_name.required' => ' الحقل مطلوب ',
      'group_name.string' => ' الحقل يجب أن يكون نصا',
    ];
  }
}