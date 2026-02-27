<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FamilySearchRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    return [
      'governorate_id' => ['nullable', 'integer', 'exists:governorates,id'],
      'city_id'        => ['nullable', 'integer', 'exists:cities,id'],
      'housing_status' => [
        'nullable',
        Rule::in(array_keys(config('options.housing_status')))
      ],
      'mother_qualifications' => [
        'nullable',
        Rule::in(array_keys(config('options.mother_qualifications')))
      ],
      'mother_education_level' => [
        'nullable',
        Rule::in(array_keys(config('options.mother_education_level')))
      ],
      'number_of_family_members' => [
        'nullable',
        Rule::in(array_keys(config('options.number_of_family_members')))
      ],
    ];
  }
  public function messages(): array
  {
    return [
      'governorate_id.integer'   => 'الإقليم المحدد غير صحيح.',
      'governorate_id.exists'    => 'الإقليم المحدد غير موجود.',
      'city_id.exists'           => 'المدينة المحددة غير  موجودة.',
      'housing_status.in'        => 'حالة المسكن المختارة غير صحيحة.',
      'mother_qualifications.in' => 'المؤهل المهني المختار غير صحيح.',
      'mother_education_level.in' => 'المستوى الدراسي المختار غير صحيح.',
      'number_of_family_members.in' => 'عدد أفراد الأسرة المختار غير صحيح.',
    ];
  }
}
