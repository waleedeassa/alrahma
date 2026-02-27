<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrphanReportRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    $rules = [
      'name' => 'required|string',
      'family_name' => 'required|string',
      'health_status' => ['required', Rule::in(array_keys(config('options.report_health_status')))],
      'going_to_nearest_doctor_or_hospital_time' => ['required', Rule::in(array_keys(config('options.going_to_nearest_doctor_or_hospital_time')))],
      'education' => ['required', Rule::in(array_keys(config('options.academic_level')))],
      'going_to_school_by' => ['required', Rule::in(array_keys(config('options.going_to_school_by')))],
      'going_to_nearest_school_time' => ['required', Rule::in(array_keys(config('options.going_to_nearest_school_time')))],
      'preferred_subject' => ['required', Rule::in(array_keys(config('options.preferred_subject')))],
      'unpreferred_subject' => ['required', Rule::in(array_keys(config('options.unpreferred_subject')))],
      'personal' => ['required', Rule::in(array_keys(config('options.personal')))],
      'like_to_become' => ['required', Rule::in(array_keys(config('options.like_to_become')))],
      'school_progress' =>  ['required', Rule::in(array_keys(config('options.school_progress')))],
      'quality_of_housing' => ['required', Rule::in(array_keys(config('options.quality_of_housing')))],
      'dwelling_place' =>   ['required', Rule::in(array_keys(config('options.dwelling_place')))],
      'type_of_dwelling' =>  ['required', Rule::in(array_keys(config('options.type_of_dwelling')))],
      'hobbies' =>  ['required', Rule::in(array_keys(config('options.hobbies')))],
      'favorite_food' =>  ['required', Rule::in(array_keys(config('options.favorite_food')))],
      'basic_food' =>   ['required', Rule::in(array_keys(config('options.basic_food')))],
      'school_name' => 'nullable|string|max:190',
      'first_term_average' => 'nullable|string|max:10',
      'second_term_average' => 'nullable|string|max:10',
      'end_year_decision' => ['nullable', Rule::in(array_keys(config('options.end_year_decision')))],
      'educational_level_changes' => ['nullable', Rule::in(array_keys(config('options.educational_level_changes')))],
      'supervisor_notes' =>  'nullable|string',
    ];
    if ($this->isMethod('post')) {
      $rules['orphan_id'] = ['required', 'numeric', 'exists:orphans,id'];
    }
    return $rules;
  }
  public function messages()
  {
    return [
      'orphan_id.required_without' => ' الحقل مطلوب',
      'orphan_id.numeric' => ' الحقل يجب أن يكون رقما',
      'orphan_id.exists' => 'رقم اليتيم غير صحيح',
      'name.required' => ' الحقل مطلوب',
      'name.string' => ' الحقل يجب أن يكون نصا',
      'family_name.required' => ' الحقل مطلوب',
      'family_name.string' => ' الحقل يجب أن يكون نصا',
      'health_status.required' => ' الحقل مطلوب',
      'health_status.in' =>  'قيمة الحقل غير صحيحه',
      'going_to_nearest_doctor_or_hospital_time.required' => ' الحقل مطلوب',
      'going_to_nearest_doctor_or_hospital_time.in' =>  'قيمة الحقل غير صحيحه',
      'education.required' => ' الحقل مطلوب',
      'education.in' =>  'قيمة الحقل غير صحيحه',
      'going_to_school_by.required' => ' الحقل مطلوب',
      'going_to_school_by.in' =>  'قيمة الحقل غير صحيحه',
      'going_to_nearest_school_time.required' => ' الحقل مطلوب',
      'going_to_nearest_school_time.in' =>  'قيمة الحقل غير صحيحه',
      'preferred_subject.required' => ' الحقل مطلوب',
      'preferred_subject.in' =>  'قيمة الحقل غير صحيحه',
      'unpreferred_subject.required' => ' الحقل مطلوب',
      'unpreferred_subject.in' =>  'قيمة الحقل غير صحيحه',
      'personal.required' => ' الحقل مطلوب',
      'personal.in' =>  'قيمة الحقل غير صحيحه',
      'like_to_become.required' => ' الحقل مطلوب',
      'like_to_become.in' =>  'قيمة الحقل غير صحيحه',
      'school_progress.required' => ' الحقل مطلوب',
      'school_progress.in' => 'قيمة الحقل غير صحيحه',
      'quality_of_housing.required' => ' الحقل مطلوب',
      'quality_of_housing.in' => 'قيمة الحقل غير صحيحه',
      'dwelling_place.required' => ' الحقل مطلوب',
      'dwelling_place.in' => 'قيمة الحقل غير صحيحه',
      'type_of_dwelling.required' => ' الحقل مطلوب',
      'type_of_dwelling.in' => 'قيمة الحقل غير صحيحه',
      'hobbies.required' => ' الحقل مطلوب',
      'hobbies.in' => 'قيمة الحقل غير صحيحه',
      'favorite_food.required' => ' الحقل مطلوب',
      'favorite_food.in' => 'قيمة الحقل غير صحيحه',
      'basic_food.required' => ' الحقل مطلوب',
      'basic_food.in' => 'قيمة الحقل غير صحيحه',
      'end_year_decision.in' => 'قيمة حقل قرار نهاية السنة غير صحيحة',
      'educational_level_changes.in' => 'قيمة حقل التغيرات الدراسية غير صحيحة',
      'first_term_average.string' => 'صيغة المعدل غير صحيحة',
      'second_term_average.string' => 'صيغة المعدل غير صحيحة',
      'supervisor_notes.string' => 'قيمة الحقل غير صحيحه',
    ];
  }
}
