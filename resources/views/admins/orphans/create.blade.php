@extends('layouts.master')
@section('title','اضافة يتيم ')
@section('breadcrumpTitle','اضافة يتيم ')
@section('css')
<style>
  .hidden {
    display: none;
  }
</style>
@endsection
@section('breadcrump')
@parent
<li class="breadcrumb-item "><a href="{{ route('admin.orphans.index') }}" class="default-color">
    الأيتام </a></li>
<li class="breadcrumb-item active">اضافة يتيم </li>
@endsection

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
        <form action="{{ route('admin.orphans.store') }}" class="modal_style" id="myForm" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <input type="hidden" name="family_id" value="{{ $family->id }}">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="name_ar" label="{{'الإسم الشخصي بالعربية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="name_fr" label="{{'الاسم الشخصي بالفرنسية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="family_name_ar" label="{{'اسم العائلة بالعربية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="family_name_fr" label="{{'اسم العائلة بالفرنسية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="birth_date" label="{{'تاريخ الازدياد ' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> الجنس</label>
              <select name="gender">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.gender') as $key => $label)
                <option value="{{ $key }}" @if (old('gender')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('gender')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.select name="governorate_id" label="{{' الإقليم ' }}" :options="$governorates" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">المدينة / الجماعة</label>
              <select name="city_id">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
              </select>
              @error('city_id')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="city_in_french" label="{{'اسم المدينة بالفرنسية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="address" label="{{'العنوان  بالعربيه' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="address_in_french" label="{{'العنوان  بالفرنسية' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="arrangement_between_brothers" label="{{'الترتيب' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">حالة الدخل</label>
              <select name="income_status">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.income_status') as $key => $label)
                <option value="{{ $key }}" @if (old('income_status')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('income_status')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="other_income" label="{{'دخل أخر' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="phone" label="{{'رقم الهاتف' }}" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الفصيلة الدموية</label>
              <select name="blood_type">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.blood_type') as $key => $label)
                <option value="{{ $key }}" @if (old('blood_type')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('blood_type')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.select name="supervisor_id" label="{{'المشرف' }}" :options="$users" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الحالة الصحية</label>
              <select name="health_status">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.health_status') as $key => $label)
                <option value="{{ $key }}" @if (old('health_status')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('health_status')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">المستوى الدراسي</label>
              <select name="academic_level">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.academic_level') as $key => $label)
                <option value="{{ $key }}" @if (old('academic_level')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('academic_level')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="shoe_size" label="{{'قياس الحذاء' }}" />
            </div>

            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="clothes_size" label="{{'قياس الملابس' }}" />
            </div>
          </div>
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <x-inputs.file name="image" id="image" label="{{'الصورة الشخصية' }}" available_formats="jpg, jpeg, png"  accept=".jpg,.jpeg,.png" />
            </div>
            <div class="form-group mb-3 col-md-md-6">
              <label for="example-fileinput" class="form-label"> </label>
              <img id="showImage" src="{{ url('dashboard/assets/images/no_image.jpg') }} " width="80px" height="80px" class="rounded-circle avatar-lg border border-secondary" alt="profile-image">
            </div>
          </div>
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <x-inputs.file accept=".jpg, .jpeg, .png, .pdf" name="attachments[]" multiple label="{{' المرفقات' }}" available_formats="jpg, jpeg, png, pdf"  accept=".jpg,.jpeg,.png,.pdf" />
            </div>
            @error('attachments')
            <span class="text-danger invalid-feedback d-block">
              {{ $message }}
            </span>
            @enderror
          </div>
          <button type="submit" class="button black x-small">حفظ</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
{{-- show hide input fields --}}
<script>
  // for mother alive select
let aliveselect = document.getElementById("aliveSelect");
let aliveDiv = document.getElementsByClassName("motherAlive"); //array

aliveselect.addEventListener("change",function (event){

  if(event.target.value === 'لا' ){
    for( let i=0 ;i<aliveDiv.length ; i++){

      aliveDiv[i].style.display = "none";
    }
    // val = "no";
  }else if(event.target.value === 'نعم'){
    for( let i=0 ;i<aliveDiv.length ; i++){
      aliveDiv[i].style.display = "block";
    }
  }
});


// for breadwineer select
let theSelect = document.getElementById("theSelect");
let theDiv = document.getElementsByClassName("breadwinner"); //array
// let val = "yes";

theSelect.addEventListener("change",function (event){

  if(event.target.value === 'لا' ){
    for( let i=0 ;i<theDiv.length ; i++){

      theDiv[i].style.display = "none";
    }
    // val = "no";
  }else if(event.target.value === 'نعم'){
    for( let i=0 ;i<theDiv.length ; i++){
      theDiv[i].style.display = "block";
    }
  }
});

</script>

{{-- preview uploaded image --}}

<script type="text/javascript">
  $(document).ready(function(){
      $('#image').change(function(e){
          var reader = new FileReader();
          reader.onload = function(e){
              $('#showImage').attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
      });
  });
</script>

{{-- validate Inputs --}}
<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
        ignore: [],
          rules: {
            name_ar: {
                required : true,
            }, 
            name_fr: {
                required : true,
            }, 
            family_name_ar: {
                required : true,
            }, 
            family_name_fr: {
                required : true,
            },
            birth_date: {
                required : true,
            }, 
            gender: {
                required : true,
            }, 
            governorate_id: {
                required : true,
            }, 
            city_id: {
                required : true,
            }, 
            city_in_french: {
                required : true,
            }, 
            address: {
                required : true,
            }, 
            address_in_french: {
                required : true,
            }, 
            arrangement_between_brothers: {
                required : true,
            }, 
            income_status: {
                required : true,
            }, 
            other_income: {
                required : true,
            }, 
            phone: {
                required : true,
            }, 
            blood_type: {
                required : true,
            }, 
            supervisor_id: {
                  required : true,
              }, 
              health_status: {
                  required : true,
              }, 
              academic_level: {
                  required : true,
              },
              shoe_size: {
                  required : true,
              },
              clothes_size: {
                  required : true,
              },
              image: {
                  required : true,
              }, 
              'attachments[]': {
                  required : true,
              }, 
          },
          messages :{
            name_ar: {
                  required : 'الإسم الشخصي بالعربية مطلوب',
              },
              name_fr: {
                  required : 'الإسم الشخصي بالفرنسية مطلوب',
              },
              family_name_ar: {
                  required : 'اسم العائلة بالعربية مطلوب',
              },
              family_name_fr: {
                  required : 'اسم العائلة بالفرنسية مطلوب',
              },
              birth_date: {
                required : 'تاريخ الإزدياد مطلوب',
              },
              gender: {
                required : 'حقل الجنس مطلوب',
              },
              governorate_id: {
                required : ' حقل الإقليم مطلوب',
              },
              city_id: {
                required : ' حقل المدينة مطلوب',
              },
              city_in_french: {
                  required : ' اسم المدينة بالفرنسية مطلوب',
              },
              address: {
                  required : '   حقل العنوان بالعربيه مطلوب',
              },
              address_in_french: {
                required : ' حقل العنوان بالفرنسية مطلوب',
              },
              arrangement_between_brothers: {
                  required : ' حقل الترتيب مطلوب',
              },
              income_status: {
                  required : '   حقل  حالة الدخل مطلوب',
              },
              other_income: {
                  required : 'حقل دخل أخر مطلوب',
              },
              phone: {
                required : 'حقل الهاتف مطلوب',
              },
              blood_type: {
                  required : ' اسم الفصيلة الدموية  مطلوب',
              },
              supervisor_id: {
                  required : 'حقل المشرف مطلوب',
              },
              health_status: {
                  required : 'حقل الحالة الصحية مطلوب',
              },
              academic_level: {
                  required : 'حقل المستوى الدراسي مطلوب',
              },
              shoe_size: {
                  required : 'حقل قياس الحذاء مطلوب',
              },
              clothes_size: {
                  required : 'حقل قياس الملابس مطلوب',
              },
              image: {
                required : '  الصورة الشخصية لليتيم مطلوبة',
              },
              'attachments[]': {
                  required : 'مرفقات اليتيم  مطلوبة',
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
              $('select[name="governorate_id"]').on('change', function() {
                  var governorate_id = $(this).val(); /* store  $(this).val() [governorate_id] in variable var governorate_id */
                  if (governorate_id) {
                      $.ajax({
                          url: "{{ route('admin.get_cities', ':id') }}".replace(':id', governorate_id),

                          /* move to url with governorate_id to get all cities using function get_cities in getCitiesController */
                          type: "GET",
                          dataType: "json",
                          success: function(data) {
                              $('select[name="city_id"]').empty(); /* in case the select named 'governorate_id' is empty [it is already empty] */
                              $('select[name="city_id"]').append('<option selected disabled >{{ 'اختر من القائمة' }}...</option>');
                              $.each(data, function(key, value) {
                                  $('select[name="city_id"]').append('<option value="' + key + '">' + value + '</option>');
                              });
                          },
                      });
                  } else {
                      console.log('AJAX load did not work');
                  }
              });
          });
</script>
@endpush