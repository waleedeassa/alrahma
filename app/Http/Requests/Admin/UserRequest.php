<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }
  public function rules(): array
  {
    $rules =  [
      'name' => ['required', 'min:2', 'max:60'],
      'family_name' => 'required|string|min:2|max:60',
      'phone' => 'required|numeric',
      'email' => ['required', 'email:filter', 'max:100', Rule::unique('users', 'email')->ignore($this->id)],
      "role_id" => 'required|numeric|exists:roles,id',
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
      'name.required' => 'حقل الاسم مطلوب',
      'name.min' => 'حقل الاسم يجب ان يكون اكثر من حرفين',
      'name.max' => 'حقل الاسم يجب ان يكون اقل من 60 حرف',
      'family_name.required' => 'اسم العائلة مطلوب',
      'family_name.min' =>  'اسم العائلة يجب ألا يقل عن حرفين',
      'family_name.max' => 'اسم العائلة يجب الا يزيد عن 60 حرف',
      'phone.required' => 'رقم الهاتف مطلوب',
      'phone.numeric' => "رقم الهاتف يجب أن يكون رقما",
      'email.required' => 'حقل البريد الالكتروني مطلوب',
      'email.email' => 'البريد الالكترونى غير صحيح',
      'email.max' => 'البريد الالكترونى يجب ان يكون اقل من 255 حرف',
      'email.unique' => 'البريد الالكترونى موجود مسبقا',
      'role_id.required' => 'نوع المستخدم مطلوب',
      'role_id.numeric' => 'نوع المستخدم غير صحيح',
      'role_id.exists' => 'نوع المستخدم غير موجود',
      'status.required' => 'حقل الحالة مطلوب',
      'status.in' => 'حقل الحالة غير صحيح',
    ];
  }
}
