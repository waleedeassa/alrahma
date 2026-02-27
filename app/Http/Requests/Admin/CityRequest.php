<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    $cityId = $this->route('city') ? $this->route('city')->id : null;
    return [
      'name' => [
        'required',
        'string',
        'min:2',
        'max:70',
        Rule::unique('cities', 'name')
          ->where('governorate_id', $this->governorate_id)
          ->ignore($cityId),
      ],
      "governorate_id" => 'required|numeric|exists:governorates,id',
    ];
  }
  public function messages()
  {
    return [
      'governorate_id.required' => 'اسم الإقليم مطلوب ',
      'governorate_id.numeric' => ' اسم الإقليم غير صحيح ',
      'governorate_id.exists' => ' اسم الإقليم غير صحيح ',
      'name.required' => ' حقل الاسم مطلوب ',
      'name.string' => ' حقل الاسم يجب أن يكون نصا',
      'name.min' => ' حقل الاسم يجب ألا يقل عن 2 أحرف',
      'name.max' => ' حقل الاسم يجب ألا يزيد عن 70 حرف',
      'name.unique' => 'اسم المدينة موجود مسبقا فى هذا الإقليم',
    ];
  }
}
