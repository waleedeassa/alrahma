<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DifficultCaseSupportProgramRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }
  protected function prepareForValidation()
  {
    // check if family_ids is a string and decode it to an array
    if ($this->has('family_ids') && is_string($this->family_ids)) {
      $decodedIds = json_decode($this->family_ids, true);
      //add the decoded array to the request
      $this->merge([
        'family_ids' => is_array($decodedIds) ? $decodedIds : [],
      ]);
    }
  }
  public function rules(): array
  {
    return [
      'support_program_id' => 'required|exists:support_programs,id',
      'date'               => 'required|date',
      'family_ids'         => 'required|array|min:1',
      'family_ids.*'       => 'integer|exists:difficult_case_families,id',
    ];
  }
  public function messages()
  {
    return [
      'support_program_id.required' => 'يرجى تحديد برنامج الدعم',
      'date.required'               => 'يرجى تحديد تاريخ الدعم',
      'family_ids.required' => 'يجب اختيار أسرة واحدة على الأقل من القائمة',
    ];
  }
}
