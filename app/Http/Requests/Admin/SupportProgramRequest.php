<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupportProgramRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|min:3|max:150|unique:support_programs,name,' . $this->id,
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'حقل اسم البرنامج مطلوب',
      'name.string'   => 'حقل الاسم يجب أن يكون نصاً',
      'name.min'      => 'حقل الاسم يجب ألا يقل عن 3 أحرف',
      'name.max'      => 'حقل الاسم يجب ألا يزيد عن 150 حرف',
      'name.unique'   => 'اسم البرنامج موجود مسبقاً',
    ];
  }
}
