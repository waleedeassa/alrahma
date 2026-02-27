<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DifficultCaseFamilySearchRequest extends FormRequest
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
      'difficult_case_type' => [
        'nullable',
        Rule::in(array_keys(config('options.difficult_case_type')))
      ],
      'social_status' => [
        'nullable',
        Rule::in(array_keys(config('options.social_status')))
      ],
      'gender' => [
        'nullable',
        Rule::in(array_keys(config('options.gender')))
      ],
      'education_level' => [
        'nullable',
        Rule::in(array_keys(config('options.education_level')))
      ],
      'family_members_count' => [
        'nullable',
        Rule::in(array_keys(config('options.number_of_family_members')))
      ],
    ];
  }

  public function messages(): array
  {
    return [
      'governorate_id.integer'     => 'الإقليم المحدد غير صحيح.',
      'governorate_id.exists'      => 'الإقليم المحدد غير موجود.',
      'city_id.integer'            => 'المدينة / الجماعة المحددة غير صحيحة.',
      'city_id.exists'             => 'المدينة / الجماعة المحددة غير موجودة.',
      'difficult_case_type.in'     => 'فئة الحالة المختارة غير صحيحة.',
      'social_status.in'           => 'الوضعية الاجتماعية المختارة غير صحيحة.',
      'gender.in'                  => 'النوع المختار غير صحيح.',
      'education_level.in'  => 'المستوى الدراسي المختار غير صحيح.',
      'family_members_count.in'    => 'عدد أفراد الأسرة المختار غير صحيح.',
    ];
  }
}
