@extends('layouts.master')
@section('title', 'اضافة أسرة ')
@section('breadcrumpTitle','اضافة أسرة ')
@section("breadcrump")
@parent
<li class="breadcrumb-item "><a href="{{ route("admin.families.index") }}" class="default-color">
    الأسر</a></li>
<li class="breadcrumb-item active">اضافة أسرة</li>
@endsection
@push('css')
<style>
  .hidden {
    display: none;
  }
</style>
@endpush
@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body" id="print">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
        </div>
        @endif
        <form action="{{ route('admin.families.store') }}" class="modal_style" id="myForm" method="POST" enctype="multipart/form-data">
          @csrf
          <h6 style="color: #84BA3F">المعلومات الجعرافيه - الإتصال</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="orphan_guardian_name" label="اسم ولي أمر اليتيم" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">صلته باليتيم</label>
              <select name="relationship_to_the_orphan">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.relationship_to_the_orphan') as $key => $label)
                <option value="{{ $key }}" @if (old('relationship_to_the_orphan')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('relationship_to_the_orphan')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="phone1" label="رقم الهاتف 1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="phone2" label="رقم الهاتف 2" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="address" label="العنوان الكامل"  />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.select name="governorate_id" label="الإقليم" :options="$governorates" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> المدينة / الجماعة</label>
              <select name="city_id">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
              </select>
              @error('city_id')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <h6 style="color: #84BA3F"> معلومات الأب المتوفي</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-4">
              <x-inputs.text name="father_job" label="مهنة الأب المتوفى" />
            </div>
            <div class="form-group mb-3 col-md-4">
              <label class="form-label" for="exampleFormControlSelect1">سبب وفاة الأب</label>
              <select name="father_death_reason">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.father_death_reason') as $key => $label)
                <option value="{{ $key }}" @if (old('father_death_reason')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('father_death_reason')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-4">
              <x-inputs.text type="date" name="father_death_date" label="{{'تاريخ وفاة الأب' }}" />
            </div>
          </div>
          <h6 style="color: #84BA3F">معلومات الأم - ولي أمر اليتيم</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل الأم متوفيه</label>
              <select name="mother_alive" id="is_mother_deceased" class="form-control">
                <option value="" selected disabled>اختر من القائمة...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_alive') !==null && old('mother_alive')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_alive')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 mother_death_details hidden">
              <x-inputs.text type="date" name="mother_death_date" label="{{'تاريخ وفاة الأم' }}" />
            </div>
            <div class="form-group mb-3 col-md-3 mother_death_details hidden">
              <label class="form-label" for="exampleFormControlSelect1">سبب وفاة الأم</label>
              <select name="mother_death_reason" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.mother_death_reason') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_death_reason')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_death_reason')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_name" label="{{'اسم الأم بالعربية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_family_name" label="{{'نسب الأم بالعربيه' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_name_in_french" label="{{'اسم الأم بالفرنسية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_family_name_in_french" label="{{'نسب الأم بالفرنسية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_id_no" label="{{'رقم البطاقة الوطنيه للأم' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="mother_id_expire_date" label="{{'تاريخ انتهاء صلاحية البطاقة الوطنية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="mother_birth_date" label="{{'تاريخ ازدياد الأم' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="bank_account_number" label="{{'الحساب البنكى' }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> التغطيه الصحيه</label>
              <select name="medical_insurance">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.medical_insurance') as $key => $label)
                <option value="{{ $key }}" @if (old('medical_insurance')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('medical_insurance')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الحالة الصحية للأم</label>
              <select name="mother_health_status">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.mother_health_status') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_health_status')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_health_status')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">عدد افراد الاسرة</label>
              <select name="number_of_family_members">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.number_of_family_members') as $key => $label)
                <option value="{{ $key }}" @if (old('number_of_family_members')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('number_of_family_members')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <h6 style="color: #84BA3F">الحالة التعليمية والمهنية للام</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">المستوى الدراسي</label>
              <select name="mother_education_level">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.mother_education_level') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_education_level')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_education_level')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">المؤهلات المهنية و الحرفية</label>
              <select name="mother_qualifications">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.mother_qualifications') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_qualifications')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_qualifications')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل تعمل الأم ؟</label>
              <select name="does_mother_work" id="does_mother_work">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('does_mother_work') !==null && old('does_mother_work')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('does_mother_work')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 mother_working_type hidden">
              <label class="form-label" for="exampleFormControlSelect1">نوع العمل</label>
              <select name="mother_working_type" id="mother_working_type">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.mother_working_type') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_working_type') !==null && old('mother_working_type')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_working_type')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <h6 style="color: #84BA3F">الدعم والاستفادات الحالية للأسرة</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل تستفيد من دعم الأرامل ؟</label>
              <select name="mother_widows_support" id="does_mother_take_widows_support">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if ( old('mother_widows_support') !==null && old('mother_widows_support')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_widows_support')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 mother_widows_support_amount hidden">
              <x-inputs.text name="mother_widows_support_amount" label="{{'مبلغ الدعم للأم' }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل تستفيد الأسرة من تعويض تقاعد الزوج؟ </label>
              <select name="has_retirement_compensation" id="has_retirement_compensation">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('has_retirement_compensation') !==null && old('has_retirement_compensation')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('has_retirement_compensation')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 husband_retirement_compensation_amount hidden">
              <x-inputs.text name="husband_retirement_compensation_amount" label=" المبلغ الشهري من تعويض تقاعد الزوج" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> هل للأرملة مصدر آخر للدخل ؟ </label>
              <select name="is_there_another_source_of_income" id="is_there_another_source_of_income">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('is_there_another_source_of_income') !==null && old('is_there_another_source_of_income')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('is_there_another_source_of_income')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 other_mother_income hidden">
              <label class="form-label" for="exampleFormControlSelect1"> مصدر الدخل الاخر</label>
              <select name="mother_other_income_type">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.mother_other_income_type') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_other_income_type')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_other_income_type')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 other_mother_income hidden">
              <x-inputs.text name="mother_other_income_amount" label="  المبلغ الشهري للدخل الأخر" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل الدخل قار ؟</label>
              <select name="is_mother_other_income_fixed">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('is_mother_other_income_fixed') !==null && old('is_mother_other_income_fixed')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('is_mother_other_income_fixed')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <h6 style="color: #84BA3F">معلومات السكن</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">صفة حيازة المسكن</label>
              <select name="housing_ownership">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.housing_ownership') as $key => $label)
                <option value="{{ $key }}" @if (old('housing_ownership')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('housing_ownership')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">نوع المسكن</label>
              <select name="housing_type">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.housing_type') as $key => $label)
                <option value="{{ $key }}" @if (old('housing_type')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('housing_type')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">حالة المسكن</label>
              <select name="housing_status">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.housing_status') as $key => $label)
                <option value="{{ $key }}" @if (old('housing_status')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('housing_status')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">مجال المسكن</label>
              <select name="housing_area">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.housing_area') as $key => $label)
                <option value="{{ $key }}" @if (old('housing_area')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('housing_area')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <h6 style="color: #84BA3F">{{'معلومات المعيل'}}</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل العائلة تتوفر على معيل؟</label>
              <select name="has_breadwinner" id="has_breadwinner">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('has_breadwinner') !==null && old('has_breadwinner')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('has_breadwinner')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 breadwinner  hidden">
              <x-inputs.text name="breadwinner_name" label="{{'اسم المعيل بالعربي' }}" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner  hidden">
              <x-inputs.text name="breadwinner_french_name" label="{{' اسم المعيل بالفرنسية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner hidden">
              <x-inputs.text name="breadwinner_family_name" label="{{'نسب المعيل بالعربيه' }}" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner hidden">
              <x-inputs.text name="breadwinner_family_in_french" label="{{'نسب المعيل بالفرنسية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner hidden">
              <x-inputs.text name="breadwinner_job" label="{{'مهنة المعيل' }}" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner hidden">
              <x-inputs.text name="breadwinner_id_no" label="{{' رقم البطاقة الوطنية للمعيل' }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');"/>
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner hidden">
              <x-inputs.text name="breadwinner_phone" label="{{' رقم هاتف المعيل' }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');"/>
            </div>
          </div>
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <label class="form-label" for="exampleFormControlSelect1"> المرفقات  <span style="color: red"> [ الصيغ المقبولة : jpg, jpeg, png , pdf ] </span></label>
              <input class="form-control" type="file" name="attachments[]" id="attachments" multiple accept=".jpg, .jpeg, .png, .pdf">
              @error('attachments.*')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>&nbsp; حفظ</button>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  document.addEventListener('DOMContentLoaded', function() {
      function setupConditionalVisibility(triggerId, targetClass) {
        const triggerElement = document.getElementById(triggerId);
        const targetElements = document.getElementsByClassName(targetClass);
          if (!triggerElement) {
              return;
          }
          function updateVisibility() {
              const shouldShow = (triggerElement.value === '1');
              for (let i = 0; i < targetElements.length; i++) {
                  targetElements[i].style.display = shouldShow ? "block" : "none";
              }
          }
          triggerElement.addEventListener("change", updateVisibility);
          updateVisibility();
      }
      setupConditionalVisibility('is_mother_deceased', 'mother_death_details');
      setupConditionalVisibility('does_mother_work', 'mother_working_type');
      setupConditionalVisibility('does_mother_take_widows_support', 'mother_widows_support_amount');
      setupConditionalVisibility('has_retirement_compensation', 'husband_retirement_compensation_amount');
      setupConditionalVisibility('is_there_another_source_of_income', 'other_mother_income');
      setupConditionalVisibility('has_breadwinner', 'breadwinner');
  });
</script>
{{-- validate Inputs --}}
<script type="text/javascript">
  $(document).ready(function (){

    $.validator.addMethod("requiredIf", function (value, element, param) {
        let target = $(param.field);
        let targetValue = param.value;
        return target.val() === targetValue ? $.trim(value).length > 0 : true;
      }, " الحقل مطلوب");
      $('#myForm').validate({
        ignore: [],
          rules: {
            "orphan_guardian_name": { required: true },
            "relationship_to_the_orphan": { required: true },
            "phone1": { required: true },
            "address": { required: true },
            "governorate_id": { required: true },
            "city_id": { required: true },
            "father_job": { required: true },
            "father_death_reason": { required: true },
            "father_death_date": { required: true },
            "mother_alive": { required: true },
            "mother_death_date" : { requiredIf: { field: "#is_mother_deceased", value: "1" } },
            "mother_death_reason" : { requiredIf: { field: "#is_mother_deceased", value: "1" } },
            "mother_name": { required: true },
            "mother_family_name": { required: true },
            "mother_name_in_french": { required: true },
            "mother_family_name_in_french": { required: true },
            "mother_id_no": { required: true },
            "mother_id_expire_date": { required: true },
            "mother_birth_date": { required: true },
            "bank_account_number": { required: true },
            "medical_insurance": { required: true },
            "mother_health_status": { required: true },
            "number_of_family_members": { required: true  },
            "mother_education_level": { required: true },
            "mother_qualifications": { required: true },
            "does_mother_work": { required: true },
            "mother_working_type": {  requiredIf: { field: "#does_mother_work", value: "1" } },
            "mother_widows_support": { required: true },
            "mother_widows_support_amount": {requiredIf: { field: "#does_mother_take_widows_support", value: "1" }  },
            "has_retirement_compensation": { required: true },
            "husband_retirement_compensation_amount": { requiredIf: { field: "#has_retirement_compensation", value: "1" } },
            "is_there_another_source_of_income": { required: true },
            "mother_other_income_type": { requiredIf: { field: "#is_there_another_source_of_income", value: "1" } },
            "mother_other_income_amount": { requiredIf: { field: "#is_there_another_source_of_income", value: "1" } },
            "is_mother_other_income_fixed": { required: true },
            "housing_ownership": { required: true },
            "housing_type": { required: true },
            "housing_status": { required: true },
            "housing_area": { required: true },
            "has_breadwinner": { required: true },
            "breadwinner_name": { requiredIf: { field: "#has_breadwinner", value: "1" } },
            "breadwinner_french_name": { requiredIf: { field: "#has_breadwinner", value: "1" } },
            "breadwinner_family_name": { requiredIf: { field: "#has_breadwinner", value: "1" } },
            "breadwinner_family_in_french": { requiredIf: { field: "#has_breadwinner", value: "1" } },
            "breadwinner_job": { requiredIf: { field: "#has_breadwinner", value: "1" } },
            "breadwinner_id_no": { requiredIf: { field: "#has_breadwinner", value: "1" } },
            "breadwinner_phone": { requiredIf: { field: "#has_breadwinner", value: "1" } }, 
            'attachments[]': {
                  required : true,
              }, 
          },
          messages :{
            "orphan_guardian_name": { required: 'الحقل مطلوب' },
            "relationship_to_the_orphan": { required: 'الحقل مطلوب' },
            "phone1": { required: 'الحقل مطلوب' },
            "address": { required: 'الحقل مطلوب' },
            "governorate_id": { required: 'الحقل مطلوب' },
            "city_id": { required: 'الحقل مطلوب' },
            "father_job": { required: 'الحقل مطلوب' },
            "father_death_reason": { required: 'الحقل مطلوب' },
            "father_death_date": { required: 'الحقل مطلوب' },
            "mother_alive": { required: 'الحقل مطلوب' },
            "mother_name": { required: 'الحقل مطلوب' },
            "mother_family_name": { required: 'الحقل مطلوب' },
            "mother_name_in_french": { required: 'الحقل مطلوب' },
            "mother_family_name_in_french": { required: 'الحقل مطلوب' },
            "mother_id_no": { required: 'الحقل مطلوب' },
            "mother_id_expire_date": { required: 'الحقل مطلوب' },
            "mother_birth_date": { required: 'الحقل مطلوب' },
            "bank_account_number": { required: 'الحقل مطلوب' },
            "medical_insurance": { required: 'الحقل مطلوب' },
            "mother_health_status": { required: 'الحقل مطلوب' },
            "number_of_family_members": { required: 'الحقل مطلوب' },
            "mother_education_level": { required: 'الحقل مطلوب' },
            "mother_qualifications": { required: 'الحقل مطلوب' },
            "does_mother_work": { required: 'الحقل مطلوب' },
            "mother_widows_support": { required: 'الحقل مطلوب' },
            "has_retirement_compensation": { required: 'الحقل مطلوب' },
            "is_there_another_source_of_income": { required: 'الحقل مطلوب' },
            "is_mother_other_income_fixed": { required: 'الحقل مطلوب' },
            "housing_ownership": { required: 'الحقل مطلوب' },
            "housing_type": { required: 'الحقل مطلوب' },
            "housing_status": { required: 'الحقل مطلوب' },
            "housing_area": { required: 'الحقل مطلوب' },
            "has_breadwinner": { required: 'الحقل مطلوب' },
            'attachments[]': {
                  required : 'مرفقات الأسرة  مطلوبة',
              },
          },
          errorElement : 'span', 
          errorPlacement: function (error,element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
          },
          highlight : function(element, errorClass, validClass){
              $(element).addClass('is-invalid');
          },
          unhighlight : function(element, errorClass, validClass){
              $(element).removeClass('is-invalid');
          },
      });
  });
  
</script>
{{-- Get governorate cities --}}
<script>
  $(document).ready(function() {
      function fetchCities(governorateId, selectedCityId = null) {
          if (governorateId) {
              $.ajax({
                  url: "{{ route('admin.get_cities', '') }}/" + governorateId,
                  type: "GET",
                  dataType: "json",
                  success: function(data) {
                      const citySelect = $('select[name="city_id"]');
                      citySelect.empty();
                      citySelect.append('<option selected disabled>{{ 'اختر من القائمة' }}...</option>');
                      $.each(data, function(key, value) {
                          const isSelected = (key == selectedCityId) ? ' selected' : '';
                          citySelect.append('<option value="' + key + '"' + isSelected + '>' + value + '</option>');
                      });
                  },
              });
          }
      }

      $('select[name="governorate_id"]').on('change', function() {
          var governorate_id = $(this).val();
          fetchCities(governorate_id);
      });
      var initialGovernorateId = $('select[name="governorate_id"]').val();
      if (initialGovernorateId) {
          var oldCityId = "{{ old('city_id') }}";
          fetchCities(initialGovernorateId, oldCityId);
      }
  });
</script>
@endpush