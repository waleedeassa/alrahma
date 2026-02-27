@extends('layouts.master')
@section('title', 'اضافة تقرير أسرة ')
@section('breadcrumpTitle','اضافة تقريرأسرة ')
@section("breadcrump")
@parent
<li class="breadcrumb-item "><a href="{{route("admin.families.index") }}" class="default-color">
    الأسر</a></li>
<li class="breadcrumb-item active">اضافة تقريرأسرة</li>
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
        <form action="{{ route('admin.store_family_report') }}" class="modal_style" id="myForm" method="POST">
          @csrf
          <h6 style="color: #84BA3F; margin-top: 30px;">معلومات السكن والمعيشة</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <label class="form-label" for="provision_status">المؤونة</label>
              <select name="provision_status" id="provision_status" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" @if (old('provision_status')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('provision_status')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-6">
              <x-inputs.text name="basic_food" label="الطعام الأساسي للأسرة" />
            </div>
            <div class="form-group mb-3 col-md-6">
              <label class="form-label" for="time_to_doctor">مدة الوصول إلى أقرب طبيب</label>
              <select name="time_to_doctor" id="time_to_doctor" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.access_time') as $key => $label)
                <option value="{{ $key }}" @if (old('time_to_doctor')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('time_to_doctor')<span class="text-danger">{{ $message }}</span>@enderror
            </div>

            <div class="form-group mb-3 col-md-6">
              <label class="form-label" for="time_to_hospital">مدة الوصول إلى أقرب مستشفى</label>
              <select name="time_to_hospital" id="time_to_hospital" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.access_time') as $key => $label)
                <option value="{{ $key }}" @if (old('time_to_hospital')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('time_to_hospital')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          <h6 style="color: #84BA3F; margin-top: 30px;">تجهيزات المسكن</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="sewage_system">قناة الصرف الصحي</label>
              <select name="sewage_system" id="sewage_system" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('sewage_system') !==null && old('sewage_system')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('sewage_system')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="electricity_network">شبكة توزيع الكهرباء</label>
              <select name="electricity_network" id="electricity_network" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.network_availability') as $key => $label)
                <option value="{{ $key }}" @if (old('electricity_network')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('electricity_network')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="water_network">شبكة توزيع الماء</label>
              <select name="water_network" id="water_network" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.network_availability') as $key => $label)
                <option value="{{ $key }}" @if (old('water_network')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('water_network')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="kitchen_setup">المطبخ</label>
              <select name="kitchen_setup" id="kitchen_setup" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.network_availability') as $key => $label)
                <option value="{{ $key }}" @if (old('kitchen_setup')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('kitchen_setup')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="cooking_method">وسيلة الطهي</label>
              <select name="cooking_method" id="cooking_method" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.cooking_method') as $key => $label)
                <option value="{{ $key }}" @if (old('cooking_method')==$key) selected @endif>{{ $label }}</option> @endforeach
              </select>
              @error('cooking_method')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="bathroom_setup">حمام</label>
              <select name="bathroom_setup" id="bathroom_setup" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.network_availability') as $key => $label)
                <option value="{{ $key }}" @if (old('bathroom_setup')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('bathroom_setup')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="refrigerator_condition">ثلاجة</label>
              <select name="refrigerator_condition" id="refrigerator_condition" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.condition_status') as $key => $label)
                <option value="{{ $key }}" @if (old('refrigerator_condition')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('refrigerator_condition')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="wardrobe_condition">خزانة ملابس</label>
              <select name="wardrobe_condition" id="wardrobe_condition" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.condition_status') as $key => $label)
                <option value="{{ $key }}" @if (old('wardrobe_condition')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('wardrobe_condition')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="bed_condition">سرير</label>
              <select name="bed_condition" id="bed_condition" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.condition_status') as $key => $label)
                <option value="{{ $key }}" @if (old('bed_condition')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('bed_condition')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="salon_condition">صالون</label>
              <select name="salon_condition" id="salon_condition" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.condition_status') as $key => $label)
                <option value="{{ $key }}" @if (old('salon_condition')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('salon_condition')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="has_tv">تلفاز</label>
              <select name="has_tv" id="has_tv" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('has_tv') !==null && old('has_tv')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('has_tv')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="has_mobile_phone">هاتف نقال</label>
              <select name="has_mobile_phone" id="has_mobile_phone" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('has_mobile_phone') !==null && old('has_mobile_phone')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('has_mobile_phone')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="has_computer">حاسوب</label>
              <select name="has_computer" id="has_computer" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('has_computer') !==null && old('has_computer')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('has_computer')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="blankets_sufficiency">أغطية</label>
              <select name="blankets_sufficiency" id="blankets_sufficiency" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" @if (old('blankets_sufficiency')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('blankets_sufficiency')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="winter_clothes_sufficiency">اللباس الشتوي والأحذية</label>
              <select name="winter_clothes_sufficiency" id="winter_clothes_sufficiency" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" @if (old('winter_clothes_sufficiency')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('winter_clothes_sufficiency')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="summer_clothes_sufficiency">اللباس الصيفي والأحذية</label>
              <select name="summer_clothes_sufficiency" id="summer_clothes_sufficiency" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" @if (old('summer_clothes_sufficiency')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('summer_clothes_sufficiency')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          <h6 style="color: #84BA3F; margin-top: 30px;">الجانب الاجتماعي والمعيشي والتغيرات خلال السنة</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="benefits_received_details" label="هل استفادت الأسرة من (المحفظة المدرسية، قفة رمضان، أضحية العيد..). حدد:" />
            </div>
            <div class="form-group mb-3 col-md-6">
              <label class="form-label" for="educational_activities_benefit">هل يستفيدون من الأنشطة التربوية؟</label>
              <select name="educational_activities_benefit" id="educational_activities_benefit" class="form-control">
                <option selected disabled>اختر...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('educational_activities_benefit') !==null && old('educational_activities_benefit')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('educational_activities_benefit')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-6">
              <x-inputs.text name="educational_activities_reason" label="إذا كان لا، ما السبب؟" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_changes_marriage_divorce" label="هل تزوج أو تطلق أحد أفراد الأسرة؟ (حدد)" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_changes_employment" label="هل اشتغل أحد أفراد الأسرة؟ (حدد)" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_changes_relocation" label="هل غيرت الأسرة مكان السكن؟ أين كانت و إلى أين انتقلت؟" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="home_repairs_details" label="هل هناك أي إصلاحات في البيت؟ اذكرها" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="new_furniture_details" label="هل اشترت الأسرة أي أثاث جديد أو معدات للمطبخ؟ حدد:" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="sponsorship_spending" label="فيم تصرف الكفالة؟" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_year_summary" label="كيف أمضت الأسرة هذه السنة؟" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_orphan_wish" label="ما هي أمنية الأسرة واليتيم؟" />
            </div>
          </div>
          <button type="submit" class="button black x-small">حفظ</button>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
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
            "number_of_family_members": { required: true },
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

@endpush