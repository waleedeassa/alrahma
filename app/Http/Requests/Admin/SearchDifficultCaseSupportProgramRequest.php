<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SearchDifficultCaseSupportProgramRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    return [
      'support_program_id' => 'nullable|integer|exists:support_programs,id',
      'from_date'          => 'nullable|date',
      'to_date'            => 'nullable|date|after_or_equal:from_date',
    ];
  }
  public function messages(): array
  {
    return [
      'support_program_id.exists'    => 'برنامج الدعم المحدد غير صحيح.',
      'support_program_id.integer'   => 'يجب اختيار برنامج دعم صالح.',
      'from_date.date'               => 'صيغة تاريخ البدء غير صحيحة.',
      'to_date.date'                 => 'صيغة تاريخ الانتهاء غير صحيحة.',
      'to_date.after_or_equal'       => 'تاريخ الانتهاء يجب أن يكون أكبر من أو يساوي تاريخ البدء.',
    ];
  }
}
