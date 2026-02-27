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
      <div class="card-body">
        @if ($errors->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <ul>
            <strong>{{ $errors->first('error') }}</strong>
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        @endif
        <form action="{{ route('admin.family-report.store') }}" id="myForm" method="POST" class="modal_style" autocomplete="off">
          @csrf
          <input type="hidden" name="family_id" value="{{ $family->id }}">
          <h6 style="color: #84BA3F; margin-top: 30px;">بيانات الاسرة</h6><br>
          <div class="row">
            <div class="form-group mb-4 col-md-4">
              <x-inputs.text name="name" label="{{'اسم ولي أمر اليتيم' }}" value="{{ $family->orphan_guardian_name }}" disabled />
            </div>
            <div class="form-group mb-4 col-md-4">
              <x-inputs.text name="governorate" label="{{' الإقليم' }}" value="{{ $family->governorate->name  }}" disabled />
            </div>
            <div class="form-group mb-4 col-md-4">
              <x-inputs.text name="city" label="{{'المدينة' }}" value="{{ $family->city->name }}" disabled />
            </div>
          </div>
          <h6 style="color: #84BA3F; margin-top: 30px;">معلومات السكن والمعيشة</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <label class="form-label" for="provision_status">المؤونة</label>
              <select name="sufficiency" id="sufficiency" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" @if (old('sufficiency')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('sufficiency')<span class="text-danger">{{ $message }}</span>@enderror
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
                  <option selected disabled value="">اختر...</option>
                  @foreach(config('options.boolean') as $key => $label)
                      <option value="{{ $key }}" @if (old('educational_activities_benefit') !== null && old('educational_activities_benefit') == $key) selected @endif>{{ $label }}</option>
                  @endforeach
              </select>
              @error('educational_activities_benefit')<span class="text-danger">{{ $message }}</span>@enderror
          </div>
          
          <div class="form-group mb-3 col-md-6" id="reason_container" style="display: none;">
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
            <div class="form-group mb-3 col-md-12">
              <label class="form-label" for="family_changes_after_sponsored"> تغيرات الأسرة بعد الكفالة</label>
              <select name="family_changes_after_sponsored" id="family_changes_after_sponsored" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.family_changes_after_sponsored') as $key => $label)
                <option value="{{ $key }}" @if (old('family_changes_after_sponsored')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('family_changes_after_sponsored')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-12">
              <label class="form-label" for="family_changes_after_sponsored_2">  تغيرات الأسرة بعد الكفالة 2</label>
              <select name="family_changes_after_sponsored_2" id="family_changes_after_sponsored_2" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.family_changes_after_sponsored') as $key => $label)
                <option value="{{ $key }}" @if (old('family_changes_after_sponsored_2')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('family_changes_after_sponsored_2')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-12">
              <label class="form-label" for="family_changes_after_sponsored_3">  تغيرات الأسرة بعد الكفالة 3</label>
              <select name="family_changes_after_sponsored_3" id="family_changes_after_sponsored_3" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.family_changes_after_sponsored') as $key => $label)
                <option value="{{ $key }}" @if (old('family_changes_after_sponsored_3')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('family_changes_after_sponsored_3')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          <button type="submit" class="button black x-small ">اضافة</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function() {
    function toggleReasonField() {
        var value = $('#educational_activities_benefit').val();
        if (value === '0' || value === 'no' || value === 'false') {
            $('#reason_container').slideDown();
        } else {
            $('#reason_container').slideUp();
            $('input[name="educational_activities_reason"]').val('');
        }
    }
    toggleReasonField();
    $('#educational_activities_benefit').on('change', function() {
        toggleReasonField();
    });
    $('#myForm').validate({
        rules: {
            sufficiency: { required: true },
            basic_food: { required: true },
            time_to_doctor: { required: true },
            time_to_hospital: { required: true },
            sewage_system: { required: true },
            electricity_network: { required: true },
            water_network: { required: true },
            kitchen_setup: { required: true },
            cooking_method: { required: true },
            bathroom_setup: { required: true },
            refrigerator_condition: { required: true },
            wardrobe_condition: { required: true },
            bed_condition: { required: true },
            salon_condition: { required: true },
            has_tv: { required: true },
            has_mobile_phone: { required: true },
            has_computer: { required: true },
            blankets_sufficiency: { required: true },
            winter_clothes_sufficiency: { required: true },
            summer_clothes_sufficiency: { required: true },
            benefits_received_details: { required: true },
            educational_activities_benefit: { required: true },
            educational_activities_reason: {
                required: function() {
                    var val = $('#educational_activities_benefit').val();
                    return val === '0' || val === 'no' || val === 'false';
                }
            },
            family_changes_marriage_divorce: { required: true },
            family_changes_employment: { required: true },
            family_changes_relocation: { required: true },
            home_repairs_details: { required: true },
            new_furniture_details: { required: true },
            sponsorship_spending: { required: true },
            family_year_summary: { required: true },
            family_orphan_wish: { required: true },
            family_changes_after_sponsored: { required: true },
        },
        messages: {
            sufficiency: { required: 'الحقل مطلوب' },
            basic_food: { required: 'الحقل مطلوب' },
            time_to_doctor: { required: 'الحقل مطلوب' },
            time_to_hospital: { required: 'الحقل مطلوب' },
            sewage_system: { required: 'الحقل مطلوب' },
            electricity_network: { required: 'الحقل مطلوب' },
            water_network: { required: 'الحقل مطلوب' },
            kitchen_setup: { required: 'الحقل مطلوب' },
            cooking_method: { required: 'الحقل مطلوب' },
            bathroom_setup: { required: 'الحقل مطلوب' },
            refrigerator_condition: { required: 'الحقل مطلوب' },
            wardrobe_condition: { required: 'الحقل مطلوب' },
            bed_condition: { required: 'الحقل مطلوب' },
            salon_condition: { required: 'الحقل مطلوب' },
            has_tv: { required: 'الحقل مطلوب' },
            has_mobile_phone: { required: 'الحقل مطلوب' },
            has_computer: { required: 'الحقل مطلوب' },
            blankets_sufficiency: { required: 'الحقل مطلوب' },
            winter_clothes_sufficiency: { required: 'الحقل مطلوب' },
            summer_clothes_sufficiency: { required: 'الحقل مطلوب' },
            benefits_received_details: { required: 'الحقل مطلوب' },
            educational_activities_benefit: { required: 'الحقل مطلوب' },
            educational_activities_reason: { required: 'الحقل مطلوب' },
            family_changes_marriage_divorce: { required: 'الحقل مطلوب' },
            family_changes_employment: { required: 'الحقل مطلوب' },
            family_changes_relocation: { required: 'الحقل مطلوب' },
            home_repairs_details: { required: 'الحقل مطلوب' },
            new_furniture_details: { required: 'الحقل مطلوب' },
            sponsorship_spending: { required: 'الحقل مطلوب' },
            family_year_summary: { required: 'الحقل مطلوب' },
            family_orphan_wish: { required: 'الحقل مطلوب' },
            family_changes_after_sponsored: { required: 'الحقل مطلوب' },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
</script>
@endpush
