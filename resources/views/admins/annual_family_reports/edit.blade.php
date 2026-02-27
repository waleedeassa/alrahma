@extends('layouts.master')
@section('title', 'تعديل تقرير أسرة')
@section('breadcrumpTitle','تعديل تقرير أسرة')
@section("breadcrump")
@parent
<li class="breadcrumb-item active">تعديل تقرير أسرة</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <form action="{{ route('admin.family-report.update', $familyReport->id) }}" class="modal_style" id="myForm" method="POST" autocomplete="off">
          @csrf
          @method('PUT')
          <input type="hidden" name="family_id" value="{{ $familyReport->family_id }}">
          <h6 style="color: #84BA3F; margin-top: 30px;">بيانات الاسرة</h6><br>
          <div class="row">
            <div class="form-group mb-4 col-md-4">
              <label>اسم ولي أمر اليتيم</label>
              <input type="text" class="form-control" value="{{ $familyReport->family->orphan_guardian_name ?? '' }}" disabled>
            </div>
            <div class="form-group mb-4 col-md-4">
              <label>الإقليم</label>
              <input type="text" class="form-control" value="{{ $familyReport->family->governorate->name ?? '' }}" disabled>
            </div>
            <div class="form-group mb-4 col-md-4">
              <label>المدينة</label>
              <input type="text" class="form-control" value="{{ $familyReport->family->city->name ?? '' }}" disabled>
            </div>
          </div>
          <h6 style="color: #84BA3F; margin-top: 30px;">معلومات السكن والمعيشة</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <label class="form-label">المؤونة</label>
              <select name="sufficiency" class="form-control">
                <option selected disabled>اختر...</option>
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" {{ old('sufficiency', $familyReport->sufficiency) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-6">
              <x-inputs.text name="basic_food" label="الطعام الأساسي للأسرة" :value="$familyReport->basic_food" />
            </div>
            <div class="form-group mb-3 col-md-6">
              <label class="form-label">مدة الوصول إلى أقرب طبيب</label>
              <select name="time_to_doctor" class="form-control">
                <option selected disabled>اختر...</option>
                @foreach(config('options.access_time') as $key => $label)
                <option value="{{ $key }}" {{ old('time_to_doctor', $familyReport->time_to_doctor) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-6">
              <label class="form-label">مدة الوصول إلى أقرب مستشفى</label>
              <select name="time_to_hospital" class="form-control">
                <option selected disabled>اختر...</option>
                @foreach(config('options.access_time') as $key => $label)
                <option value="{{ $key }}" {{ old('time_to_hospital', $familyReport->time_to_hospital) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <h6 style="color: #84BA3F; margin-top: 30px;">تجهيزات المسكن</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">قناة الصرف الصحي</label>
              <select name="sewage_system" class="form-control">
                <option selected disabled>اختر...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" {{ old('sewage_system', $familyReport->sewage_system) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">شبكة توزيع الكهرباء</label>
              <select name="electricity_network" class="form-control">
                <option selected disabled>اختر...</option>
                @foreach(config('options.network_availability') as $key => $label)
                <option value="{{ $key }}" {{ old('electricity_network', $familyReport->electricity_network) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">شبكة توزيع الماء</label>
              <select name="water_network" class="form-control">
                <option selected disabled>اختر...</option>
                @foreach(config('options.network_availability') as $key => $label)
                <option value="{{ $key }}" {{ old('water_network', $familyReport->water_network) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">المطبخ</label>
              <select name="kitchen_setup" class="form-control">
                <option selected disabled>اختر...</option>
                @foreach(config('options.network_availability') as $key => $label)
                <option value="{{ $key }}" {{ old('kitchen_setup', $familyReport->kitchen_setup) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">وسيلة الطهي</label>
              <select name="cooking_method" class="form-control">
                @foreach(config('options.cooking_method') as $key => $label)
                <option value="{{ $key }}" {{ old('cooking_method', $familyReport->cooking_method) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">حمام</label>
              <select name="bathroom_setup" class="form-control">
                @foreach(config('options.network_availability') as $key => $label)
                <option value="{{ $key }}" {{ old('bathroom_setup', $familyReport->bathroom_setup) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">ثلاجة</label>
              <select name="refrigerator_condition" class="form-control">
                @foreach(config('options.condition_status') as $key => $label)
                <option value="{{ $key }}" {{ old('refrigerator_condition', $familyReport->refrigerator_condition) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">خزانة ملابس</label>
              <select name="wardrobe_condition" class="form-control">
                @foreach(config('options.condition_status') as $key => $label)
                <option value="{{ $key }}" {{ old('wardrobe_condition', $familyReport->wardrobe_condition) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">سرير</label>
              <select name="bed_condition" class="form-control">
                @foreach(config('options.condition_status') as $key => $label)
                <option value="{{ $key }}" {{ old('bed_condition', $familyReport->bed_condition) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">صالون</label>
              <select name="salon_condition" class="form-control">
                @foreach(config('options.condition_status') as $key => $label)
                <option value="{{ $key }}" {{ old('salon_condition', $familyReport->salon_condition) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">تلفاز</label>
              <select name="has_tv" class="form-control">
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" {{ old('has_tv', $familyReport->has_tv) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">هاتف نقال</label>
              <select name="has_mobile_phone" class="form-control">
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" {{ old('has_mobile_phone', $familyReport->has_mobile_phone) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">حاسوب</label>
              <select name="has_computer" class="form-control">
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" {{ old('has_computer', $familyReport->has_computer) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">أغطية</label>
              <select name="blankets_sufficiency" class="form-control">
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" {{ old('blankets_sufficiency', $familyReport->blankets_sufficiency) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">اللباس الشتوي</label>
              <select name="winter_clothes_sufficiency" class="form-control">
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" {{ old('winter_clothes_sufficiency', $familyReport->winter_clothes_sufficiency) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">اللباس الصيفي</label>
              <select name="summer_clothes_sufficiency" class="form-control">
                @foreach(config('options.sufficiency') as $key => $label)
                <option value="{{ $key }}" {{ old('summer_clothes_sufficiency', $familyReport->summer_clothes_sufficiency) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <h6 style="color: #84BA3F; margin-top: 30px;">الجانب الاجتماعي والمعيشي والتغيرات خلال السنة</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="benefits_received_details" label="استفادة الأسرة (محفظة، قفة، أضحية...)" :value="$familyReport->benefits_received_details" />
            </div>
            <div class="form-group mb-3 col-md-6">
              <label class="form-label">هل يستفيدون من الأنشطة التربوية؟</label>
              <select name="educational_activities_benefit" id="educational_activities_benefit" class="form-control">
                <option selected disabled value="">اختر...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" {{ old('educational_activities_benefit', $familyReport->educational_activities_benefit) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-6" id="reason_container" style="display: none;">
              <x-inputs.text name="educational_activities_reason" label="إذا كان لا، ما السبب؟" :value="$familyReport->educational_activities_reason" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_changes_marriage_divorce" label="هل تزوج أو تطلق أحد أفراد الأسرة؟ (حدد)" :value="$familyReport->family_changes_marriage_divorce" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_changes_employment" label="هل اشتغل أحد أفراد الأسرة؟ (حدد)" :value="$familyReport->family_changes_employment" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_changes_relocation" label="هل غيرت الأسرة مكان السكن؟ أين كانت و إلى أين انتقلت؟" :value="$familyReport->family_changes_relocation" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="home_repairs_details" label="هل هناك أي إصلاحات في البيت؟ اذكرها" :value="$familyReport->home_repairs_details" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="new_furniture_details" label="هل اشترت الأسرة أي أثاث جديد أو معدات للمطبخ؟ حدد:" :value="$familyReport->new_furniture_details" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="sponsorship_spending" label="فيم تصرف الكفالة" :value="$familyReport->sponsorship_spending" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_year_summary" label="كيف أمضت الأسرة هذه السنة؟" :value="$familyReport->family_year_summary" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="family_orphan_wish" label="ما هي أمنية الأسرة واليتيم؟" :value="$familyReport->family_orphan_wish" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <label class="form-label">تغيرات الأسرة بعد الكفالة</label>
              <select name="family_changes_after_sponsored" class="form-control">
                @foreach(config('options.family_changes_after_sponsored') as $key => $label)
                <option value="{{ $key }}" {{ old('family_changes_after_sponsored', $familyReport->family_changes_after_sponsored) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-12">
              <label class="form-label">تغيرات الأسرة بعد الكفالة 2</label>
              <select name="family_changes_after_sponsored_2" class="form-control">
                @foreach(config('options.family_changes_after_sponsored') as $key => $label)
                <option value="{{ $key }}" {{ old('family_changes_after_sponsored_2', $familyReport->family_changes_after_sponsored_2) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-12">
              <label class="form-label">تغيرات الأسرة بعد الكفالة 3</label>
              <select name="family_changes_after_sponsored_3" class="form-control">
                @foreach(config('options.family_changes_after_sponsored') as $key => $label)
                <option value="{{ $key }}" {{ old('family_changes_after_sponsored_3', $familyReport->family_changes_after_sponsored_3) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="button black x-small">حفظ التعديلات</button>
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
