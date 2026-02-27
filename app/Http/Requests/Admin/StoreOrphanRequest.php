<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrphanRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    $orphanId = $this->route('orphan') ? $this->route('orphan')->id : null;
    $fileRule = $orphanId ? 'nullable' : 'required';

    return [
      'family_id'         => [$fileRule, 'integer', 'exists:families,id'],
      'name_ar'           => ['required', 'string', 'max:255'],
      'name_fr'           => ['required', 'string', 'max:255'],
      'family_name_ar'    => ['required', 'string', 'max:255'],
      'family_name_fr'    => ['required', 'string', 'max:255'],
      'birth_date'        => ['required', 'date', 'before:today'],
      'gender'            => ['required', Rule::in(array_keys(config('options.gender')))],
      'governorate_id'    => ['required', 'integer', 'exists:governorates,id'],
      'city_id'           => ['required', 'integer', 'exists:cities,id'],
      'city_in_french'    => ['required', 'string', 'max:255'],
      'address'           => ['required', 'string', 'max:500'],
      'address_in_french' => ['required', 'string', 'max:500'],
      'arrangement_between_brothers' => ['required', 'string', 'max:255'],
      'phone'             => ['required', 'string', 'max:20'],
      'income_status'     => ['required', Rule::in(array_keys(config('options.income_status')))],
      'other_income'      => ['required', 'string', 'max:255'],
      'blood_type'        => ['required', Rule::in(array_keys(config('options.blood_type')))],
      'health_status'     => ['required', Rule::in(array_keys(config('options.health_status')))],
      'supervisor_id'     => ['required', 'integer', 'exists:users,id'],
      'academic_level'    => ['required', Rule::in(array_keys(config('options.academic_level')))],
      'shoe_size'         => ['required', 'string', 'max:50'],
      'clothes_size'      => ['required', 'string', 'max:50'],
      'image'             => [$fileRule, 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
      'attachments'       => [$fileRule, 'array', 'min:1'],
      'attachments.*'     => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
      'sponsor_id'       => ['nullable', 'integer', 'exists:sponsors,id'],
      'orphan_sponsorship_code' => ['nullable', 'string', 'max:50', Rule::unique('orphans', 'orphan_sponsorship_code')->ignore($orphanId)],
      'cancellation_reason' => ['nullable',Rule::in(array_keys(config('options.sponsorship_cancellation_reason')))
      ],
    ];
  }
  public function messages()
  {
    return [
      'family_id.required'      => 'يجب اختيار الأسرة.',
      'name_ar.required'        => 'الاسم الشخصي بالعربية مطلوب.',
      'name_fr.required'        => 'الاسم الشخصي بالفرنسية مطلوب.',
      'family_name_ar.required' => 'اسم العائلة بالعربية مطلوب.',
      'family_name_fr.required' => 'اسم العائلة بالفرنسية مطلوب.',
      'birth_date.required'     => 'تاريخ الازدياد مطلوب.',
      'birth_date.before'       => 'تاريخ الازدياد يجب أن يكون قبل تاريخ اليوم.',
      'gender.required'         => 'يرجى تحديد الجنس.',
      'gender.in'               => 'القيمة المختارة للجنس غير صحيحة.',
      'governorate_id.required' => 'يرجى اختيار الإقليم.',
      'city_id.required'        => 'يرجى اختيار المدينة.',
      'city_in_french.required' => 'اسم المدينة بالفرنسية مطلوب.',
      'address.required'        => 'العنوان بالعربية مطلوب.',
      'address_in_french.required' => 'العنوان بالفرنسية مطلوب.',
      'arrangement_between_brothers.required' => 'حقل الترتيب مطلوب.',
      'phone.required'          => 'رقم الهاتف مطلوب.',
      'income_status.required'  => 'يرجى تحديد حالة الدخل.',
      'other_income.required'   => 'حقل دخل آخر مطلوب.',
      'blood_type.required'     => 'يرجى تحديد الفصيلة الدموية.',
      'health_status.required'  => 'يرجى تحديد الحالة الصحية.',
      'supervisor_id.required'  => 'يرجى اختيار المشرف.',
      'academic_level.required' => 'يرجى تحديد المستوى الدراسي.',
      'shoe_size.required'      => 'حقل حجم الحذاء مطلوب.',
      'clothes_size.required'   => 'حقل حجم الملابس مطلوب.',
      'image.required'          => 'الصورة الشخصية لليتيم مطلوبة.',
      'image.image'             => 'الملف المرفوع يجب أن يكون صورة.',
      'image.mimes'             => 'صيغة الصورة يجب أن تكون (jpg, jpeg, png).',
      'image.max'               => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
      'attachments.required'    => 'المرفقات مطلوبة.',
      'attachments.min'         => 'يجب رفع مرفق واحد على الأقل.',
      'attachments.*.mimes'     => 'صيغة المرفقات يجب أن تكون (jpg, jpeg, png, pdf).',
      'attachments.*.max'       => 'حجم كل مرفق يجب ألا يتجاوز 2 ميجابايت.',
      'sponsor_id.exists'       => 'الكفيل المختار غير موجود.',
      'orphan_sponsorship_code.max' => 'كود الكفالة يجب ألا يتجاوز 50 حرفًا.',
      'orphan_sponsorship_code.unique' => 'كود الكفالة يجب ان يكون فريد.',
      'cancellation_reason.in' => 'القيمة المختارة لسبب الإلغاء غير صحيحة.',
    ];
  }
}
