@extends('layouts.master')
@section('title', 'تعديل بيانات الأسرة ' )
@section('breadcrumpTitle', 'تعديل بيانات أسرة')

@section("breadcrump")
@parent
<li class="breadcrumb-item "><a href="{{ route("admin.families.index") }}" class="default-color">الأسر</a></li>
<li class="breadcrumb-item active">تعديل بيانات أسرة</li>
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
          <strong>حدث خطأ! يرجى مراجعة الحقول التالية:</strong>
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('admin.families.update', $family->id) }}" class="modal_style" id="myForm" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <h6 style="color: #84BA3F">المعلومات الجغرافية - الاتصال</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="orphan_guardian_name" label="اسم ولي أمر اليتيم" :value="old('orphan_guardian_name', $family->orphan_guardian_name)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="relationship_to_the_orphan">صلته باليتيم</label>
              <select name="relationship_to_the_orphan" id="relationship_to_the_orphan" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.relationship_to_the_orphan') as $key => $label)
                <option value="{{ $key }}" @if(old('relationship_to_the_orphan', $family->relationship_to_the_orphan) == $key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('relationship_to_the_orphan')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="phone1" label="رقم الهاتف 1" :value="old('phone1', $family->phone1)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="phone2" label="رقم الهاتف 2" :value="old('phone2', $family->phone2)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="address" label="العنوان الكامل" :value="old('address', $family->address)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.select name="governorate_id" label="الإقليم" :options="$governorates" :selected="old('governorate_id', $family->governorate_id)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="city_id">المدينة / الجماعة</label>
              <select name="city_id" id="city_id" class="form-control">
                <option selected disabled>اختر الإقليم أولاً...</option>
              </select>
              @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>

          <h6 style="color: #84BA3F"> معلومات الأب المتوفي</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-4">
              <x-inputs.text name="father_job" label="مهنة الأب المتوفى" :value="old('father_job', $family->father_job)" />
            </div>
            <div class="form-group mb-3 col-md-4">
              <label class="form-label" for="father_death_reason">سبب وفاة الأب</label>
              <select name="father_death_reason" id="father_death_reason" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.father_death_reason') as $key => $label)
                <option value="{{ $key }}" @if(old('father_death_reason', $family->father_death_reason) == $key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('father_death_reason')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-4">
              <x-inputs.text type="date" name="father_death_date" label="تاريخ وفاة الأب" :value="old('father_death_date', $family->father_death_date)" />
            </div>
          </div>

          <h6 style="color: #84BA3F">معلومات الأم - ولي أمر اليتيم</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="is_mother_deceased">هل الأم متوفيه</label>
              <select name="mother_alive" id="is_mother_deceased" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if(old('mother_alive', $family->mother_alive) == $key ) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_alive')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3 mother_death_details @if((old('mother_alive', $family->mother_alive) != '0')) hidden @endif"">
              <x-inputs.text type=" date" name="mother_death_date" label="تاريخ وفاة الأم" :value="old('mother_death_date', $family->mother_death_date)" />
          </div>
          <div class="form-group mb-3 col-md-3 mother_death_details @if((old('mother_alive', $family->mother_alive) != '0')) hidden @endif"">
              <label class=" form-label" for="mother_death_reason">سبب وفاة الأم</label>
            <select name="mother_death_reason" class="form-control">
              <option selected disabled>اختر من القائمة...</option>
              @foreach(config('options.mother_death_reason') as $key => $label)
              <option value="{{ $key }}" @if(old('mother_death_reason', $family->mother_death_reason) == $key) selected @endif>{{ $label }}</option>
              @endforeach
            </select>
            @error('mother_death_reason')<span class="text-danger">{{ $message }}</span>@enderror
          </div>
          <div class="form-group mb-3 col-md-3">
            <x-inputs.text name="mother_name" label="اسم الأم بالعربية" :value="old('mother_name', $family->mother_name)" />
          </div>
          <div class="form-group mb-3 col-md-3">
            <x-inputs.text name="mother_family_name" label="نسب الأم بالعربية" :value="old('mother_family_name', $family->mother_family_name)" />
          </div>
          <div class="form-group mb-3 col-md-3">
            <x-inputs.text name="mother_name_in_french" label="اسم الأم بالفرنسية" :value="old('mother_name_in_french', $family->mother_name_in_french)" />
          </div>
          <div class="form-group mb-3 col-md-3">
            <x-inputs.text name="mother_family_name_in_french" label="نسب الأم بالفرنسية" :value="old('mother_family_name_in_french', $family->mother_family_name_in_french)" />
          </div>
          <div class="form-group mb-3 col-md-3">
            <x-inputs.text name="mother_id_no" label="رقم البطاقة الوطنية للأم" :value="old('mother_id_no', $family->mother_id_no)"  />
          </div>
          <div class="form-group mb-3 col-md-3">
            <x-inputs.text type="date" name="mother_id_expire_date" label="تاريخ انتهاء صلاحية البطاقة" :value="old('mother_id_expire_date', $family->mother_id_expire_date)" />
          </div>
          <div class="form-group mb-3 col-md-3">
            <x-inputs.text type="date" name="mother_birth_date" label="تاريخ ازدياد الأم" :value="old('mother_birth_date', $family->mother_birth_date)" />
          </div>
          <div class="form-group mb-3 col-md-3">
            <x-inputs.text name="bank_account_number" label="الحساب البنكي" :value="old('bank_account_number', $family->bank_account_number)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
          </div>
          <div class="form-group mb-3 col-md-3">
            <label class="form-label" for="medical_insurance">التغطية الصحية</label>
            <select name="medical_insurance" id="medical_insurance" class="form-control">
              <option disabled>اختر من القائمة...</option>
              @foreach(config('options.medical_insurance') as $key => $label)
              <option value="{{ $key }}" @if(old('medical_insurance', $family->medical_insurance) == $key) selected @endif>{{ $label }}</option>
              @endforeach
            </select>
            @error('medical_insurance')<span class="text-danger">{{ $message }}</span>@enderror
          </div>
          <div class="form-group mb-3 col-md-3">
            <label class="form-label" for="mother_health_status">الحالة الصحية للأم</label>
            <select name="mother_health_status" id="mother_health_status" class="form-control">
              <option disabled>اختر من القائمة...</option>
              @foreach(config('options.mother_health_status') as $key => $label)
              <option value="{{ $key }}" @if(old('mother_health_status', $family->mother_health_status) == $key) selected @endif>{{ $label }}</option>
              @endforeach
            </select>
            @error('mother_health_status')<span class="text-danger">{{ $message }}</span>@enderror
          </div>
          <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">عدد افراد الاسرة</label>
              <select name="number_of_family_members">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.number_of_family_members') as $key => $label)
                <option value="{{ $key }}" @if (old('number_of_family_members', $family->number_of_family_members)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('number_of_family_members')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
      </div>

      <h6 style="color: #84BA3F">الحالة التعليمية والمهنية للأم</h6><br>
      <div class="row">
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="mother_education_level">المستوى الدراسي</label>
          <select name="mother_education_level" id="mother_education_level" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.mother_education_level') as $key => $label)
            <option value="{{ $key }}" @if(old('mother_education_level', $family->mother_education_level) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('mother_education_level')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="mother_qualifications">المؤهلات المهنية و الحرفية</label>
          <select name="mother_qualifications" id="mother_qualifications" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.mother_qualifications') as $key => $label)
            <option value="{{ $key }}" @if(old('mother_qualifications', $family->mother_qualifications) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('mother_qualifications')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="does_mother_work">هل تعمل الأم ؟</label>
          <select name="does_mother_work" id="does_mother_work" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.boolean') as $key => $label)
            <option value="{{ $key }}" @if(old('does_mother_work', $family->does_mother_work) == $key ) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('does_mother_work')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3 mother_working_type  @if((old('does_mother_work',$family->does_mother_work) != '1' )) hidden @endif ">
          <label class="form-label" for="mother_working_type">نوع العمل</label>
          <select name="mother_working_type" id="mother_working_type" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.mother_working_type') as $key => $label)
            <option value="{{ $key }}" @if(old('mother_working_type', $family->mother_working_type) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('mother_working_type')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
      </div>

      <h6 style="color: #84BA3F">الدعم والاستفادات الحالية للأسرة</h6><br>
      <div class="row">
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="does_mother_take_widows_support">هل تستفيد من دعم الأرامل ؟</label>
          <select name="mother_widows_support" id="does_mother_take_widows_support" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.boolean') as $key => $label)
            <option value="{{ $key }}" @if(old('mother_widows_support', $family->mother_widows_support) == $key ) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('mother_widows_support')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3 mother_widows_support_amount @if((old('mother_widows_support', $family->mother_widows_support) != '1')) hidden @endif">
          <x-inputs.text name="mother_widows_support_amount" label="مبلغ الدعم للأم" :value="old('mother_widows_support_amount', $family->mother_widows_support_amount)"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
        </div>
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="has_retirement_compensation">هل تستفيد الأسرة من تعويض تقاعد الزوج؟</label>
          <select name="has_retirement_compensation" id="has_retirement_compensation" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.boolean') as $key => $label)
            <option value="{{ $key }}" @if(old('has_retirement_compensation', $family->has_retirement_compensation) == $key ) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('has_retirement_compensation')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3 husband_retirement_compensation_amount  @if((old('has_retirement_compensation', $family->has_retirement_compensation) != '1')) hidden @endif">
          <x-inputs.text name="husband_retirement_compensation_amount" label="المبلغ الشهري من تعويض تقاعد الزوج" :value="old('husband_retirement_compensation_amount', $family->husband_retirement_compensation_amount)"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
        </div>
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="is_there_another_source_of_income">هل للأرملة مصدر آخر للدخل ؟</label>
          <select name="is_there_another_source_of_income" id="is_there_another_source_of_income" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.boolean') as $key => $label)
            <option value="{{ $key }}" @if(old('is_there_another_source_of_income', $family->is_there_another_source_of_income) == $key ) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('is_there_another_source_of_income')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3 other_mother_income @if((old('is_there_another_source_of_income', $family->is_there_another_source_of_income) != '1')) hidden @endif">
          <label class="form-label" for="mother_other_income_type">مصدر الدخل الاخر</label>
          <select name="mother_other_income_type" id="mother_other_income_type" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.mother_other_income_type') as $key => $label)
            <option value="{{ $key }}" @if(old('mother_other_income_type', $family->mother_other_income_type) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('mother_other_income_type')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3 other_mother_income @if((old('is_there_another_source_of_income', $family->is_there_another_source_of_income) != '1')) hidden @endif">
          <x-inputs.text name="mother_other_income_amount" label="المبلغ الشهري للدخل الأخر" :value="old('mother_other_income_amount', $family->mother_other_income_amount)"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
        </div>
        <div class="form-group mb-3 col-md-3 other_mother_income @if((old('is_there_another_source_of_income', $family->is_there_another_source_of_income) != '1')) hidden @endif">
          <label class="form-label" for="is_mother_other_income_fixed">هل الدخل قار ؟</label>
          <select name="is_mother_other_income_fixed" id="is_mother_other_income_fixed" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.boolean') as $key => $label)
            <option value="{{ $key }}" @if(old('is_mother_other_income_fixed', $family->is_mother_other_income_fixed) == $key ) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('is_mother_other_income_fixed')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
      </div>

      <h6 style="color: #84BA3F">معلومات السكن</h6><br>
      <div class="row">
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="housing_ownership">صفة حيازة المسكن</label>
          <select name="housing_ownership" id="housing_ownership" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.housing_ownership') as $key => $label)
            <option value="{{ $key }}" @if(old('housing_ownership', $family->housing_ownership) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('housing_ownership')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="housing_type">نوع المسكن</label>
          <select name="housing_type" id="housing_type" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.housing_type') as $key => $label)
            <option value="{{ $key }}" @if(old('housing_type', $family->housing_type) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('housing_type')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="housing_status">حالة المسكن</label>
          <select name="housing_status" id="housing_status" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.housing_status') as $key => $label)
            <option value="{{ $key }}" @if(old('housing_status', $family->housing_status) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('housing_status')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="housing_area">مجال المسكن</label>
          <select name="housing_area" id="housing_area" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.housing_area') as $key => $label)
            <option value="{{ $key }}" @if(old('housing_area', $family->housing_area) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('housing_area')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
      </div>

      <h6 style="color: #84BA3F">معلومات المعيل</h6><br>
      <div class="row">
        <div class="form-group mb-3 col-md-3">
          <label class="form-label" for="has_breadwinner">هل العائلة تتوفر على معيل؟</label>
          <select name="has_breadwinner" id="has_breadwinner" class="form-control">
            <option disabled>اختر من القائمة...</option>
            @foreach(config('options.boolean') as $key => $label)
            <option value="{{ $key }}" @if(old('has_breadwinner', $family->has_breadwinner) == $key) selected @endif>{{ $label }}</option>
            @endforeach
          </select>
          @error('has_breadwinner')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-3 col-md-3 breadwinner  @if((old('has_breadwinner', $family->has_breadwinner) != '1')) hidden @endif">
          <x-inputs.text name="breadwinner_name" label="اسم المعيل بالعربي" :value="old('breadwinner_name', $family->breadwinner_name)" />
        </div>
        <div class="form-group mb-3 col-md-3 breadwinner  @if((old('has_breadwinner', $family->has_breadwinner) != '1')) hidden @endif">
          <x-inputs.text name="breadwinner_french_name" label="اسم المعيل بالفرنسية" :value="old('breadwinner_french_name', $family->breadwinner_french_name)" />
        </div>
        <div class="form-group mb-3 col-md-3 breadwinner  @if((old('has_breadwinner', $family->has_breadwinner) != '1')) hidden @endif">
          <x-inputs.text name="breadwinner_family_name" label="نسب المعيل بالعربية" :value="old('breadwinner_family_name', $family->breadwinner_family_name)" />
        </div>
        <div class="form-group mb-3 col-md-3 breadwinner  @if((old('has_breadwinner', $family->has_breadwinner) != '1')) hidden @endif">
          <x-inputs.text name="breadwinner_family_in_french" label="نسب المعيل بالفرنسية" :value="old('breadwinner_family_in_french', $family->breadwinner_family_in_french)" />
        </div>
        <div class="form-group mb-3 col-md-3 breadwinner  @if((old('has_breadwinner', $family->has_breadwinner) != '1')) hidden @endif">
          <x-inputs.text name="breadwinner_job" label="مهنة المعيل" :value="old('breadwinner_job', $family->breadwinner_job)" />
        </div>
        <div class="form-group mb-3 col-md-3 breadwinner  @if((old('has_breadwinner', $family->has_breadwinner) != '1')) hidden @endif">
          <x-inputs.text name="breadwinner_id_no" label="رقم البطاقة الوطنية للمعيل" :value="old('breadwinner_id_no', $family->breadwinner_id_no)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
        </div>
        <div class="form-group mb-3 col-md-3 breadwinner  @if((old('has_breadwinner', $family->has_breadwinner) != '1')) hidden @endif">
          <x-inputs.text name="breadwinner_phone" label="رقم هاتف المعيل" :value="old('breadwinner_phone', $family->breadwinner_phone)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
        </div>
      </div>
      <h6 style="color: #84BA3F">المرفقات</h6><br>
      <div class="row">
        <div class="form-group mb-3 col-md-6">
          <label class="form-label" for="attachments">إضافة مرفقات جديدة (اختياري)    <span style="color: red"> [ الصيغ المقبولة : jpg, jpeg, png , pdf ] </span></label></label>
          <input class="form-control" type="file" name="attachments[]" id="attachments" multiple accept=".jpg, .jpeg, .png, .pdf">
          @error('attachments.*')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>&nbsp; تعديل</button>
      </form>
    </div>
    <br>
    @if ($family->attachments->count() > 0)
    <div class="form-group mb-3 col-md-12">
      {{-- <h6 style="color: #84BA3F"> المرفقات</h6><br> --}}
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered p-0" style="text-align: center">
            <thead>
              <tr class="table-head">
                <th scope="col">#</th>
                <th scope="col">اسم الملف</th>
                <th scope="col">تاريخ الإنشاء</th>
                <th scope="col">العمليات</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($family->attachments as $attachment)
              <tr style='text-align:center;vertical-align:middle' id="attachment-row-{{ $attachment->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $attachment->original_name }}</td>
                <td>{{ $attachment->created_at->diffForHumans() }}</td>
                <td>
                  <a class="btn btn-dark btn-sm" href="{{ route('admin.view_family_attachment', $attachment) }}" target="_blank" role="button"><i class="fa fa-eye"></i>&nbsp;{{ 'عرض' }}</a>
                  <a class="btn btn-success btn-sm" href="{{ route('admin.download_family_attachment',  $attachment) }}" role="button"><i class="fa fa-cloud-download"></i>&nbsp;{{ 'تحميل' }}</a>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete_img{{ $attachment->id  }}" title="حذف"><i class="fa fa-trash"></i>&nbsp;{{'حذف'}}
                  </button>
                </td>
              </tr>
              <div class="modal fade" id="Delete_img{{ $attachment->id  }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Delete attachment  -->
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ 'حذف المرفقات' }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form  action="{{ route('admin.delete_family_attachment', $attachment ) }}" method="post">
                        @csrf
                        {{'هل أنت متأكد من حذف المرفق ؟' }}
                        <input type="hidden" name="id" value="{{ $attachment->id  }}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{'اغلاق'}}</button>
                      <button class="btn btn-success">{{'موافق'}}</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif


  </div>
</div>
</div>
@endsection

@push('js')

{{-- show or hide fields --}}
<script>
  // does_mother_work
  $(document).on('change','#does_mother_work',function(e){
 if($(this).val()=='1'  ){
$(".mother_working_type").show();
 }else{
   $(".mother_working_type").hide();
 }
   });
  // does_mother_work
  $(document).on('change','#does_mother_work',function(e){
  if($(this).val() == '1'){
    $(".mother_working_type").show();
  } else {
    $(".mother_working_type").hide();
  }
});
// does_mother_take_widows_support
$(document).on('change','#does_mother_take_widows_support',function(e){
  if($(this).val() == '1'){
    $(".mother_widows_support_amount").show();
  } else {
    $(".mother_widows_support_amount").hide();
  }
});
// does mother take retirement compensation
$(document).on('change','#has_retirement_compensation',function(e){
  if($(this).val() == '1'){
    $(".husband_retirement_compensation_amount").show();
  } else {
    $(".husband_retirement_compensation_amount").hide();
  }
});
// is there another source of income
$(document).on('change','#is_there_another_source_of_income',function(e){
  if($(this).val() == '1'){
    $(".other_mother_income").show();
  } else {
    $(".other_mother_income").hide();
  }
});
// is there breadwinner
$(document).on('change','#has_breadwinner',function(e){
  if($(this).val() == '1'){
    $(".breadwinner").show();
  } else {
    $(".breadwinner").hide();
  }
});   
</script>
{{-- // Delete attachment --}}
<script>
  $(document).ready(function() {
      $('.delete-attachment-form').on('submit', function(e) {
          e.preventDefault();
          let form = $(this);
          let url = form.attr('action');
          let attachmentId = form.data('attachment-id'); 
          let submitButton = form.find('button[type="submit"]');
          $.ajax({
              url: url,
              type: 'POST',
              data: form.serialize(), 
              success: function(response) {
                  if (response.success) {
                      $('#Delete_img' + attachmentId).modal('hide');
                      $('#attachment-row-' + attachmentId).fadeOut(500, function() { $(this).remove(); });
                      toastr.success(response.message);
                  } else {
                      toastr.error(response.message || 'حدث خطأ ما.');
                      submitButton.prop('disabled', false).html('نعم، قم بالحذف');
                  }
              },
              error: function() {
                  toastr.error('حدث خطأ غير متوقع في الاتصال.');
                  submitButton.prop('disabled', false).html('نعم، قم بالحذف');
              }
          });
      });
  });
</script>
{{-- jQuery Validate Logic --}}
<script type="text/javascript">
  $(document).ready(function (){
    $.validator.addMethod("requiredIf", function (value, element, param) {
        let target = $(param.field);
        let targetValue = param.value;
        // Check if the target is visible before requiring the field
        if (target.val() === targetValue && $(element).is(':visible')) {
            return $.trim(value).length > 0;
        }
        return true;
      }, "الحقل مطلوب");

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
            "mother_death_date" : { requiredIf: { field: "#is_mother_deceased", value: "0" } },
            "mother_death_reason" : { requiredIf: { field: "#is_mother_deceased", value: "0" } },
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
            "number_of_family_members": { required: true },
            "mother_education_level": { required: true },
            "mother_qualifications": { required: true },
            "does_mother_work": { required: true },
            "mother_working_type": { requiredIf: { field: "#does_mother_work", value: "1" } },
            "mother_widows_support": { required: true },
            "mother_widows_support_amount": { requiredIf: { field: "#does_mother_take_widows_support", value: "1" } },
            "has_retirement_compensation": { required: true },
            "husband_retirement_compensation_amount": { requiredIf: { field: "#has_retirement_compensation", value: "1" } },
            "is_there_another_source_of_income": { required: true },
            "mother_other_income_type": { requiredIf: { field: "#is_there_another_source_of_income", value: "1" } },
            "mother_other_income_amount": { requiredIf: { field: "#is_there_another_source_of_income", value: "1" } },
            "is_mother_other_income_fixed": { requiredIf: { field: "#is_there_another_source_of_income", value: "1" } },
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
          },
          messages: {
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
            "number_of_family_members": { required: 'الحقل مطلوب'},
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

{{-- Get governorate cities logic --}}
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
                      citySelect.append('<option disabled>اختر من القائمة...</option>');
                      $.each(data, function(key, value) {
                          const isSelected = (key == selectedCityId) ? ' selected' : '';
                          citySelect.append('<option value="' + key + '"' + isSelected + '>' + value + '</option>');
                      });
                  },
              });
          }
      }

      $('select[name="governorate_id"]').on('change', function() {
          fetchCities($(this).val());
      });

      var initialGovernorateId = $('select[name="governorate_id"]').val();
      if (initialGovernorateId) {
          var cityIdToSelect = "{{ old('city_id', $family->city_id) }}";
          fetchCities(initialGovernorateId, cityIdToSelect);
      }
  });
</script>
@endpush