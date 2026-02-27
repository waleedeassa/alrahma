<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AssignSponsorshipsRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {
    return [
      'sponsor_id' => 'required|exists:sponsors,id',
      'orphan_ids' => 'required|array|min:1',
      'orphan_ids.*' => ['required', 'exists:orphans,id', 'distinct'],
      'sponsorship_codes' => 'required|array|min:1',
      'sponsorship_codes.*' => 'required|string|max:100',
    ];
  }

  public function messages()
  {
    return [
      'sponsor_id.required' => 'يجب اختيار كفيل.',
      'sponsor_id.exists' => 'الكفيل المحدد غير موجود.',
      'orphan_ids.required' => 'يجب اختيار يتيم واحد على الاقل.',
      'orphan_ids.*.required' => 'يجب اختيار يتيم واحد على الاقل.',
      'orphan_ids.*.exists' => 'اليتيم المحدد غير موجود.',
      'orphan_ids.*.distinct' => 'لايمكن اختيار نفس اليتيم مرتين.',
      'sponsorship_codes.required' => 'يجب اختيار كود واحد على الاقل.',
      'sponsorship_codes.*' => 'يجب اختيار كود واحد على الاقل.',
    ];
  }
}
