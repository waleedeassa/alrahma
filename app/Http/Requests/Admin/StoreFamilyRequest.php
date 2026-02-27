<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFamilyRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    $familyId = $this->route('family') ? $this->route('family')->id : null;

    return [
      // Guardian and Address
      'orphan_guardian_name'        => ['required', 'string', 'max:255'],
      'relationship_to_the_orphan'   => ['required', Rule::in(array_keys(config('options.relationship_to_the_orphan')))],
      'phone1'                       => ['required', 'string', 'max:20'],
      'phone2'                       => ['nullable', 'string', 'max:20'],
      'address'                      => ['required', 'string', 'max:500'],
      'governorate_id'               => ['required', 'exists:governorates,id'],
      'city_id'                      => ['required', 'exists:cities,id'],
      // Father
      'father_job'                   => ['required', 'string', 'max:255'],
      'father_death_reason'          => ['required', Rule::in(array_keys(config('options.father_death_reason')))],
      'father_death_date'            => ['required', 'date', 'before_or_equal:today'],
      // Mother
      'mother_alive'                 => ['required', 'boolean'],
      'mother_death_date'            => ['nullable', 'required_if:mother_alive,1', 'date', 'before_or_equal:today'],
      'mother_death_reason'          => ['nullable', 'required_if:mother_alive,1', Rule::in(array_keys(config('options.mother_death_reason')))],
      'mother_name'                  => ['required', 'string', 'max:255'],
      'mother_birth_date'            => ['required', 'date', 'before_or_equal:today'],
      'mother_family_name'           => ['required', 'string', 'max:255'],
      'mother_name_in_french'        => ['required', 'string', 'max:255'],
      'mother_family_name_in_french' => ['required', 'string', 'max:255'],
      'mother_id_no'                 => ['required', 'string', 'max:50'],
      'mother_id_expire_date'        => ['required', 'date'],
      'bank_account_number'          => ['required', 'string', 'max:100'],
      'medical_insurance'            => ['required', Rule::in(array_keys(config('options.medical_insurance')))],
      'mother_health_status'         => ['required', Rule::in(array_keys(config('options.mother_health_status')))],
      'number_of_family_members'           => ['required', Rule::in(array_keys(config('options.number_of_family_members')))],
      'mother_education_level'       => ['required', Rule::in(array_keys(config('options.mother_education_level')))],
      'mother_qualifications'        => ['required', Rule::in(array_keys(config('options.mother_qualifications')))],
      'does_mother_work'             => ['required', 'boolean'],
      'mother_working_type'             => ['nullable', 'required_if:does_mother_work,1', Rule::in(array_keys(config('options.mother_working_type')))],
      'mother_widows_support'        => ['required', 'boolean'],
      'mother_widows_support_amount' => ['nullable', 'required_if:mother_widows_support,1', 'numeric', 'min:0'],
      'has_retirement_compensation'  => ['required', 'boolean'],
      'husband_retirement_compensation_amount' => ['nullable', 'required_if:has_retirement_compensation,1', 'numeric', 'min:0'],
      'is_there_another_source_of_income' => ['required', 'boolean'],
      'mother_other_income_type'     => ['nullable', 'required_if:is_there_another_source_of_income,1', Rule::in(array_keys(config('options.mother_other_income_type')))],
      'mother_other_income_amount'   => ['nullable', 'required_if:is_there_another_source_of_income,1', 'numeric', 'min:0'],
      'is_mother_other_income_fixed' => ['nullable', 'required_if:is_there_another_source_of_income,1', 'boolean'],
      // Housing Information
      'housing_ownership'            => ['required', Rule::in(array_keys(config('options.housing_ownership')))],
      'housing_type'                 => ['required', Rule::in(array_keys(config('options.housing_type')))],
      'housing_status'               => ['required', Rule::in(array_keys(config('options.housing_status')))],
      'housing_area'                 => ['required', Rule::in(array_keys(config('options.housing_area')))],
      // Breadwinner Information
      'has_breadwinner'              => ['required', 'boolean'],
      'breadwinner_name'             => ['nullable', 'required_if:has_breadwinner,1', 'string', 'max:255'],
      'breadwinner_french_name'      => ['nullable', 'required_if:has_breadwinner,1', 'string', 'max:255'],
      'breadwinner_family_name'      => ['nullable',  'required_if:has_breadwinner,1', 'string', 'max:255'],
      'breadwinner_family_in_french' => ['nullable',  'required_if:has_breadwinner,1', 'string', 'max:255'],
      'breadwinner_job'              => ['nullable',  'required_if:has_breadwinner,1', 'string', 'max:255'],
      'breadwinner_id_no'            => ['nullable',  'required_if:has_breadwinner,1', 'string', 'max:50'],
      'breadwinner_phone'            => ['nullable',  'required_if:has_breadwinner,1', 'string', 'max:255'],
      // Attachments
      'attachments'                  => [$familyId ? 'nullable' : 'required', 'array'],
      'attachments.*'                => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
    ];
  }
  public function messages(): array
  {
    return [
      'required'        => 'حقل ":attribute" مطلوب.',
      'string'          => 'حقل ":attribute" يجب أن يكون نصاً.',
      'date'            => 'حقل ":attribute" يجب أن يكون تاريخاً صحيحاً.',
      'boolean'         => 'حقل ":attribute" غير صالح.',
      'numeric'         => 'حقل ":attribute" يجب أن يكون رقماً.',
      'in'              => 'القيمة المحددة في حقل ":attribute" غير صالحة.',
      'exists'          => 'القيمة المحددة في حقل ":attribute" غير موجودة.',
      'unique'          => 'القيمة المدخلة في حقل ":attribute" مستخدمة من قبل.',
      'required_if'     => 'حقل ":attribute" مطلوب.',
      'array'           => 'حقل ":attribute" يجب أن يكون مصفوفة.',
      'file'            => 'حقل ":attribute" يجب أن يكون ملفاً.',
      'max.file'        => 'يجب ألا يتجاوز حجم ":attribute" :max كيلوبايت.',
      'max.string'      => 'يجب ألا يتجاوز نص ":attribute" :max حرفاً.',
      'mimes'           => 'يجب أن يكون نوع ملف ":attribute" واحداً من: :values.',
      'after'           => 'حقل ":attribute" يجب أن يكون تاريخاً بعد اليوم.',
      'before_or_equal' => 'حقل ":attribute" يجب أن يكون تاريخاً في الماضي أو اليوم.',
      'after_or_equal'  => 'حقل ":attribute" يجب أن يكون تاريخاً بعد أو مطابقاً لـ ":date".',
      'attachments.required' => 'يجب رفع ملف واحد على الأقل.',
    ];
  }
  public function attributes(): array
  {
    return [
      'orphan_guardian_name'        => 'اسم ولي أمر اليتيم',
      'relationship_to_the_orphan'   => 'صلته باليتيم',
      'phone1'                       => 'رقم الهاتف 1',
      'phone2'                       => 'رقم الهاتف 2',
      'address'                      => 'العنوان الكامل',
      'governorate_id'               => 'الإقليم',
      'city_id'                      => 'المدينة / الجماعة',
      'father_job'                   => 'مهنة الأب المتوفى',
      'father_death_reason'          => 'سبب وفاة الأب',
      'father_death_date'            => 'تاريخ وفاة الأب',
      'mother_alive'                 => 'هل الأم متوفيه',
      'mother_death_date'            => 'تاريخ وفاة الأم',
      'mother_death_reason'          => 'سبب وفاة الأم',
      'mother_name'                  => 'اسم الأم',
      'mother_birth_date'            => 'تاريخ ازدياد الأم',
      'mother_family_name'           => 'نسب الأم',
      'mother_name_in_french'        => 'اسم الأم بالفرنسية',
      'mother_family_name_in_french' => 'نسب الأم بالفرنسية',
      'mother_id_no'                 => 'رقم البطاقة الوطنية',
      'mother_id_expire_date'        => 'تاريخ انتهاء صلاحية البطاقة',
      'bank_account_number'          => 'رقم الحساب البنكي',
      'medical_insurance'            => 'التغطية الصحية',
      'mother_health_status'         => 'الحالة الصحية للأم',
      'number_of_family_members'           => 'عدد أفراد الاسرة',
      'mother_education_level'       => 'المستوى الدراسي',
      'mother_qualifications'        => 'المؤهلات المهنية',
      'does_mother_work'             => 'هل تعمل الأم',
      'mother_working_type'             => 'نوع العمل',
      'mother_widows_support'        => 'دعم الأرامل',
      'mother_widows_support_amount' => 'مبلغ دعم الأرامل',
      'has_retirement_compensation'  => 'تعويض تقاعد الزوج',
      'husband_retirement_compensation_amount' => 'مبلغ تعويض التقاعد',
      'is_there_another_source_of_income' => 'مصدر آخر للدخل',
      'mother_other_income_type'     => 'نوع الدخل الآخر',
      'mother_other_income_amount'   => 'مبلغ الدخل الآخر',
      'is_mother_other_income_fixed' => 'هل الدخل الآخر قار',
      'housing_ownership'            => 'صفة حيازة المسكن',
      'housing_type'                 => 'نوع المسكن',
      'housing_status'               => 'حالة المسكن',
      'housing_area'                 => 'مجال المسكن',
      'has_breadwinner'              => 'هل يوجد معيل',
      'breadwinner_name'             => 'اسم المعيل',
      'breadwinner_french_name'      => 'اسم المعيل بالفرنسية',
      'breadwinner_family_name'      => 'نسب المعيل',
      'breadwinner_family_in_french' => 'نسب المعيل بالفرنسية',
      'breadwinner_job'              => 'مهنة المعيل',
      'breadwinner_phone'            => 'رقم هاتف المعيل',
      'breadwinner_id_no'            => 'رقم البطاقة الوطنية للمعيل',
      'attachments'                  => 'المرفقات',
      'attachments.*'                => 'الملف المرفق',
    ];
  }
}
