<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupportProgramEntryRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'support_program_id' => ['required', 'exists:support_programs,id'],
      'beneficiary_category' => [
        'required',
        'string',
        'in:' . implode(',', array_keys(config('options.support_beneficiary_categories'))),
      ],
      'beneficiaries_count' => ['required', 'integer', 'min:1'],
      'funding_source' => ['required', 'string', 'max:255'],
      'date' => ['required', 'date'],
      'notes' => ['nullable', 'string'],
      'attachments' => ['nullable', 'array'],
      'attachments.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:3072'], 
    ];
  }

  public function messages(): array
  {
    return [
      'support_program_id.required' => 'برجاء اختيار البرنامج',
      'beneficiary_category.required' => 'برجاء اختيار الفئة',
      'beneficiaries_count.required' => 'برجاء إدخال عدد المستفيدين',
      'beneficiaries_count.min' => 'عدد المستفيدين يجب أن يكون أكبر من صفر',
      'funding_source.required' => 'برجاء إدخال الجهة الممولة',
      'date.required' => 'برجاء إدخال التاريخ',
      'attachments.*.image' => 'الملفات المرفقة يجب أن تكون صور',
      'attachments.*.mimes' => 'الصور المرفقة يجب أن تكون من نوع jpeg,jpg,png,webp',
      'attachments.*.max' => 'حجم كل صورة مرفقة يجب ألا يتجاوز 3 MB',
    ];
  }
}
