<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    return [
      'name' => 'required|string|min:3|max:70|unique:governorates,name,' . $this->id,
    ];
  }
  public function messages()
  {
    return [
      'name.required' => ' حقل الاسم مطلوب ',
      'name.string' => ' حقل الاسم يجب أن يكون نصا',
      'name.min' => ' حقل الاسم يجب ألا يقل عن 3 أحرف',
      'name.max' => ' حقل الاسم يجب ألا يزيد عن 70 حرف',
      'name.unique' => 'اسم الإقليم موجود مسبقا',
    ];
  }
}
