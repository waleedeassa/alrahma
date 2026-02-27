<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFamilyReportRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'family_id' => 'required|exists:families,id',
      'sufficiency' => ['required', Rule::in(array_keys(config('options.sufficiency')))],
      'basic_food' => 'required|string|max:255',
      'time_to_doctor' =>  ['required', Rule::in(array_keys(config('options.access_time')))],
      'time_to_hospital' =>  ['required', Rule::in(array_keys(config('options.access_time')))],
      'sewage_system' => ['required', Rule::in(array_keys(config('options.boolean')))],
      'electricity_network' => ['required', Rule::in(array_keys(config('options.network_availability')))],
      'water_network' => ['required', Rule::in(array_keys(config('options.network_availability')))],
      'kitchen_setup' => ['required', Rule::in(array_keys(config('options.network_availability')))],
      'cooking_method' => ['required', Rule::in(array_keys(config('options.cooking_method')))],
      'bathroom_setup' => ['required', Rule::in(array_keys(config('options.network_availability')))],
      'refrigerator_condition' => ['required', Rule::in(array_keys(config('options.condition_status')))],
      'wardrobe_condition' => ['required', Rule::in(array_keys(config('options.condition_status')))],
      'bed_condition' => ['required', Rule::in(array_keys(config('options.condition_status')))],
      'salon_condition' => ['required', Rule::in(array_keys(config('options.condition_status')))],
      'has_tv' => ['required', Rule::in(array_keys(config('options.boolean')))],
      'has_mobile_phone' => ['required', Rule::in(array_keys(config('options.boolean')))],
      'has_computer' => ['required', Rule::in(array_keys(config('options.boolean')))],
      'blankets_sufficiency' => ['required', Rule::in(array_keys(config('options.sufficiency')))],
      'winter_clothes_sufficiency' => ['required', Rule::in(array_keys(config('options.sufficiency')))],
      'summer_clothes_sufficiency' => ['required', Rule::in(array_keys(config('options.sufficiency')))],
      'benefits_received_details' => 'required|string',
      'educational_activities_benefit' => ['required', Rule::in(array_keys(config('options.boolean')))],
      'educational_activities_reason' => 'required_if:educational_activities_benefit,0|nullable|string',
      'family_changes_marriage_divorce' => 'required|string',
      'family_changes_employment' => 'required|string',
      'family_changes_relocation' => 'required|string',
      'home_repairs_details' => 'required|string',
      'new_furniture_details' => 'required|string',
      'sponsorship_spending' => 'required|string',
      'family_year_summary' => 'required|string',
      'family_orphan_wish' => 'required|string',
      'family_changes_after_sponsored' => ['required', Rule::in(array_keys(config('options.family_changes_after_sponsored')))],
      'family_changes_after_sponsored_2' => ['nullable', Rule::in(array_keys(config('options.family_changes_after_sponsored')))],
      'family_changes_after_sponsored_3' => ['nullable', Rule::in(array_keys(config('options.family_changes_after_sponsored')))],
    ];
  }

  public function messages(): array
  {
    return [
      'required' => 'حقل :attribute مطلوب',
      'required_if' => 'حقل :attribute مطلوب',
      'string' => 'حقل :attribute يجب أن يكون نصاً',
      'boolean' => 'حقل :attribute يجب أن يكون نعم أو لا',
      'exists' => ':attribute غير موجود',
      'max' => 'حقل :attribute يجب ألا يتجاوز :max حرف',
      'in' => 'حقل :attribute يجب ان يكون من :values',
    ];
  }

  public function attributes(): array
  {
    return [
      'family_id' => 'معرف الأسرة',
      'sufficiency' => 'المؤونة',
      'basic_food' => 'الطعام الأساسي',
      'time_to_doctor' => 'مدة الوصول للطبيب',
      'time_to_hospital' => 'مدة الوصول للمستشفى',
      'sewage_system' => 'قناة الصرف الصحي',
      'electricity_network' => 'شبكة الكهرباء',
      'water_network' => 'شبكة الماء',
      'kitchen_setup' => 'المطبخ',
      'cooking_method' => 'وسيلة الطهي',
      'bathroom_setup' => 'الحمام',
      'refrigerator_condition' => 'الثلاجة',
      'wardrobe_condition' => 'خزانة الملابس',
      'bed_condition' => 'السرير',
      'salon_condition' => 'الصالون',
      'has_tv' => 'التلفاز',
      'has_mobile_phone' => 'الهاتف النقال',
      'has_computer' => 'الحاسوب',
      'blankets_sufficiency' => 'الأغطية',
      'winter_clothes_sufficiency' => 'اللباس الشتوي',
      'summer_clothes_sufficiency' => 'اللباس الصيفي',
      'benefits_received_details' => 'تفاصيل الاستفادة',
      'educational_activities_benefit' => 'الاستفادة من الأنشطة',
      'educational_activities_reason' => 'سبب عدم الاستفادة',
      'family_changes_marriage_divorce' => 'الزواج أو الطلاق',
      'family_changes_employment' => 'التوظيف',
      'family_changes_relocation' => 'تغيير السكن',
      'home_repairs_details' => 'إصلاحات البيت',
      'new_furniture_details' => 'الأثاث الجديد',
      'sponsorship_spending' => 'صرف الكفالة',
      'family_year_summary' => 'ملخص السنة',
      'family_orphan_wish' => 'أمنية الأسرة',
      'family_changes_after_sponsored' => 'التغيرات بعد الكفالة',
    ];
  }
}
