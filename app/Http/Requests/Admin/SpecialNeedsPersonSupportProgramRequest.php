<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SpecialNeedsPersonSupportProgramRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  protected function prepareForValidation()
  {
    if ($this->has('beneficiary_ids') && is_string($this->beneficiary_ids)) {
      $decodedIds = json_decode($this->beneficiary_ids, true);
      $this->merge([
        'beneficiary_ids' => is_array($decodedIds) ? $decodedIds : [],
      ]);
    }
  }
  public function rules(): array
  {
    return [
      'support_program_id' => 'required|exists:support_programs,id',
      'date'               => 'required|date',
      'beneficiary_ids'    => 'required|array|min:1',
      'beneficiary_ids.*'  => 'integer|exists:special_needs_people,id',
    ];
  }
  public function messages()
  {
    return [
      'support_program_id.required' => 'يرجى تحديد برنامج الدعم',
      'support_program_id.exists'   => 'برنامج الدعم المختار غير صحيح',
      'date.required'               => 'يرجى تحديد تاريخ الدعم',
      'beneficiary_ids.required'    => 'يجب اختيار مستفيد واحد على الأقل من القائمة',
      'beneficiary_ids.min'         => 'يجب اختيار مستفيد واحد على الأقل',
      'beneficiary_ids.*.exists'    => 'أحد المستفيدين المختارين غير موجود في قاعدة البيانات',
    ];
  }
}
