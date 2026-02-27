@extends('layouts.master')
@section('title', 'تعديل مريض  -  ذو احتياج خاص')
@section('breadcrumpTitle', 'تعديل مريض  -  ذو احتياج خاص')

@section("breadcrump")
@parent
<li class="breadcrumb-item ">
  <a href="{{ route("admin.special-needs-people.index") }}" class="default-color">
    المرضى وذوي الاحتياجات الخاصة
  </a>
</li>
<li class="breadcrumb-item active">تعديل مريض  -  ذو احتياج خاص</li>
@endsection
@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <form action="{{ route('admin.special-needs-people.update', $specialNeedsPerson->id) }}" class="modal_style" id="specialNeedsPersonForm" method="POST">
          @csrf
          @method('PUT')
          <h6 style="color: #84BA3F">معلومات الحالة الأساسية</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="registration_date" label="تاريخ التسجيل" :value="old('registration_date', $specialNeedsPerson->registration_date)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="first_name_ar" label="الاسم الشخصي بالعربية" :value="old('first_name_ar', $specialNeedsPerson->first_name_ar)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="last_name_ar" label="الاسم العائلي بالعربية" :value="old('last_name_ar', $specialNeedsPerson->last_name_ar)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="first_name_fr" label="الاسم الشخصي بالفرنسية" :value="old('first_name_fr', $specialNeedsPerson->first_name_fr)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="last_name_fr" label="الاسم العائلي بالفرنسية" :value="old('last_name_fr', $specialNeedsPerson->last_name_fr)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="national_id_no" label="رقم البطاقة الوطنية" :value="old('national_id_no', $specialNeedsPerson->national_id_no)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">النوع</label>
              <select name="gender" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.gender') as $key => $label)
                <option value="{{ $key }}" @if(old('gender', $specialNeedsPerson->gender) == $key) selected @endif>
                  {{ $label }}
                </option>
                @endforeach
              </select>
              @error('gender')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="birth_date" label="تاريخ الازدياد" :value="old('birth_date', $specialNeedsPerson->birth_date)" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">المستوى الدراسي</label>
              <select name="education_level" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.education_level') as $key => $label)
                <option value="{{ $key }}" @if(old('education_level', $specialNeedsPerson->education_level) == $key) selected @endif>
                  {{ $label }}
                </option>
                @endforeach
              </select>
              @error('education_level')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">عدد افراد الاسرة</label>
              <select name="family_members_count">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.number_of_family_members') as $key => $label)
                <option value="{{ $key }}" @if(old('family_members_count', $specialNeedsPerson->family_members_count)==$key) selected @endif>
                  {{ $label }}
                </option>
                @endforeach
              </select>
              @error('family_members_count')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">نوع الاحتياج</label>
              <select name="special_needs_type" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.special_needs_type') as $key => $label)
                <option value="{{ $key }}" @if(old('special_needs_type', $specialNeedsPerson->special_needs_type) == $key) selected @endif>
                  {{ $label }}
                </option>
                @endforeach
              </select>
              @error('special_needs_type')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">الوضعية الاجتماعية</label>
              <select name="social_status" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.social_status') as $key => $label)
                <option value="{{ $key }}" @if(old('social_status', $specialNeedsPerson->social_status) == $key) selected @endif>
                  {{ $label }}
                </option>
                @endforeach
              </select>
              @error('social_status')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          <h6 style="color: #84BA3F">المعلومات الجغرافية - الإتصال</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-4">
              <x-inputs.select name="governorate_id" label="الإقليم" :options="$governorates" :selected="old('governorate_id', $specialNeedsPerson->governorate_id)" />
            </div>
            <div class="form-group mb-3 col-md-4">
              <label class="form-label">المدينة / الجماعة</label>
              <select name="city_id" class="form-control">
                <option disabled>اختر الإقليم أولاً...</option>
              </select>
              @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group mb-3 col-md-4">
              <x-inputs.text name="phone" label="رقم الهاتف" :value="old('phone', $specialNeedsPerson->phone)" oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="address" label="العنوان الكامل" :value="old('address', $specialNeedsPerson->address)" />
            </div>
          </div>
          <button type="submit" class="btn btn-success">
            <i class="fa fa-floppy-o"></i>&nbsp; تعديل
          </button>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function (){
      $('#difficultCaseFamilyForm').validate({
        ignore: [],
          rules: { 
            registration_date: { required: true },
            first_name_ar: { required: true }, last_name_ar: { required: true }, first_name_fr: { required: true }, last_name_fr: { required: true }, national_id_no: { required: true }, gender: { required: true }, birth_date: { required: true }, education_level: { required: true }, family_members_count: { required: true  }, special_needs_type: { required: true }, social_status: { required: true }, governorate_id: { required: true }, city_id: { required: true }, address: { required: true }, phone: { required: true }, },
          messages :{ registration_date: { required: 'الحقل مطلوب' }, first_name_ar: { required: 'الحقل مطلوب' }, last_name_ar: { required: 'الحقل مطلوب' }, first_name_fr: { required: 'الحقل مطلوب' }, last_name_fr: { required: 'الحقل مطلوب' }, national_id_no: { required: 'الحقل مطلوب' }, gender: { required: 'الحقل مطلوب' }, birth_date: { required: 'الحقل مطلوب' }, education_level: { required: 'الحقل مطلوب' }, family_members_count: { required: 'الحقل مطلوب', min: 'الحقل يجب ان يكون على الاقل 1', max: 'الحقل يجب ان يكون على الاقل 50' }, special_needs_type: { required: 'الحقل مطلوب' }, social_status: { required: 'الحقل مطلوب' }, governorate_id: { required: 'الحقل مطلوب' }, city_id: { required: 'الحقل مطلوب' }, address: { required: 'الحقل مطلوب' }, phone: { required: 'الحقل مطلوب' }, },
          errorElement : 'span', 
          errorPlacement: function (error,element) { error.addClass('invalid-feedback'); element.closest('.form-group').append(error); },
          highlight : function(element, errorClass, validClass){ $(element).addClass('is-invalid'); },
          unhighlight : function(element, errorClass, validClass){ $(element).removeClass('is-invalid'); },
      });
  });
</script>
{{-- get cities --}}
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
          var cityIdToSelect = "{{ old('city_id', $specialNeedsPerson->city_id) }}";
          fetchCities(initialGovernorateId, cityIdToSelect);
      }
  });
</script>
@endpush