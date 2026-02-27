<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SponsorRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    $sponsorId = $this->route('sponsor') ? $this->route('sponsor')->id : null;
    $rules = [
      'name' => 'required|string|max:255',
      'type' => ['required', Rule::in(array_keys(config('options.sponsor_type')))],
      'email' => ['required', 'email:filter', 'max:255', Rule::unique('sponsors', 'email')->ignore( $sponsorId)],
      'phone' => ['required', 'string', 'max:20', Rule::unique('sponsors', 'phone')->ignore($sponsorId)],
      'status' => 'sometimes|boolean',
      'address' => 'nullable|string|max:255',
    ];

    if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
      $rules['status'] = ['required', 'in:1,0'];
    } else {
      $rules['status'] = ['nullable', 'in:1,0'];
    }
    return $rules;
  }

  public function messages(): array
  {
    return [
      'name.required' => 'الاسم مطلوب',
      'name.max' => 'الاسم يجب ان يكون اقل من 255 حرف',
      'email.required' => 'البريد الالكترونى مطلوب',
      'email.email' => 'البريد الالكترونى غير صحيح',
      'email.unique' => 'البريد الالكترونى موجود مسبقا',
      'email.max' => 'البريد الالكترونى يجب ان يكون اقل من 255 حرف',
      'phone.required' => 'الهاتف مطلوب',
      'phone.string' => 'الهاتف يجب ان يكون نص',
      'phone.unique' => 'الهاتف موجود مسبقا',
      'phone.max' => 'الهاتف يجب ان يكون اقل من 20 رقم',
      'type.required' => 'نوع الكفيل مطلوب',
      'type.in' => 'نوع الكفيل غير صحيح',
      'address.max' => 'العنوان يجب ان يكون اقل من 255 حرف',
    ];
  }
}
