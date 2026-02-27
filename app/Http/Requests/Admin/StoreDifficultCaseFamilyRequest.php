<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDifficultCaseFamilyRequest extends FormRequest
{

  public function authorize(): bool
  {

    return true;
  }
  public function rules(): array
  {
    $caseId = $this->route('difficultCaseFamily') ? $this->route('difficultCaseFamily')->id : null;
    return [
      'registration_date' => ['required', 'date', 'before_or_equal:today'],
      'first_name_ar' => ['required', 'string', 'max:255'],
      'last_name_ar' => ['required', 'string', 'max:255'],
      'first_name_fr' => ['required', 'string', 'max:255'],
      'last_name_fr' => ['required', 'string', 'max:255'],
      'national_id_no' => ['required', 'string', 'max:50'],
      'gender' => ['required', Rule::in(array_keys(config('options.gender')))],
      'birth_date' => ['required', 'date', 'before_or_equal:today'],
      'education_level' => ['required', Rule::in(array_keys(config('options.education_level')))],
      'family_members_count' => ['required', Rule::in(array_keys(config('options.number_of_family_members'))),],
      'difficult_case_type' => ['required', Rule::in(array_keys(config('options.difficult_case_type')))],
      'social_status' => ['required', Rule::in(array_keys(config('options.social_status')))],
      'governorate_id' => ['required', 'exists:governorates,id'],
      'city_id' => ['required', 'exists:cities,id'],
      'address' => ['required', 'string', 'max:500'],
      'phone' => ['required', 'string', 'max:20'],
    ];
  }
  public function messages(): array
  {
    return [
      'required' => 'حقل ":attribute" مطلوب.',
      'string' => 'حقل ":attribute" يجب أن يكون نصاً.',
      'date' => 'حقل ":attribute" يجب أن يكون تاريخاً صحيحاً.',
      'numeric' => 'حقل ":attribute" يجب أن يكون رقماً.',
      'in' => 'القيمة المحددة في حقل ":attribute" غير صالحة.',
      'exists' => 'القيمة المحددة في حقل ":attribute" غير موجودة.',
      'unique' => 'القيمة المدخلة في حقل ":attribute" مستخدمة من قبل.',
      'max.string' => 'يجب ألا يتجاوز نص ":attribute" :max حرفاً.',
      'before_or_equal' => 'حقل ":attribute" يجب أن يكون تاريخاً في الماضي أو اليوم.',
      'min' => 'حقل ":attribute" يجب ان يكون على الاقل :min.',
      'max' => 'حقل ":attribute" يجب ان يكون على الاقل :max.',
    ];
  }
  public function attributes(): array
  {
    return [
      'registration_date' => 'تاريخ التسجيل',
      'first_name_ar' => 'الاسم الشخصي بالعربية',
      'last_name_ar' => 'الاسم العائلي بالعربية',
      'first_name_fr' => 'الاسم الشخصي بالفرنسية',
      'last_name_fr' => 'الاسم العائلي بالفرنسية',
      'national_id_no' => 'رقم البطاقة الوطنية',
      'gender' => 'النوع',
      'birth_date' => 'تاريخ الازدياد',
      'education_level' => 'المستوى الدراسي',
      'family_members_count' => 'عدد أفراد الأسرة',
      'difficult_case_type' => 'فئة الحالة',
      'social_status' => 'الوضعية الاجتماعية',
      'governorate_id' => 'الإقليم',
      'city_id' => 'المدينة / الجماعة',
      'address' => 'العنوان الكامل',
      'phone' => 'رقم الهاتف',
    ];
  }
}
