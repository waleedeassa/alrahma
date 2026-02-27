@extends('layouts.master')
@section('title', 'تعديل أسرة ')
@section('breadcrumpTitle','تعديل أسرة ')
@push('css')
<style>
  .hidden {
    display: none;
  }
</style>
@endpush
{{-- @section('breadcrump')
@parent
<li class="breadcrumb-item "><a href="{{ route('admin.families.index') }}" class="default-color">
    الأسر </a></li>
<li class="breadcrumb-item active">تعديل أسرة </li>
@endsection --}}

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
        <form action="{{ route('admin.families.update',$family) }}" id="myForm" class="modal_style" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <h6 style="color: #84BA3F">{{'معلومات العائلة'}}</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="family_name" label="{{'اسم العائلة' }}" :value="$family->family_name" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="income" label="{{'الدخل' }}" :value="$family->income" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="bank_account_number" label="{{'الحساب البنكى' }}" :value="$family->bank_account_number" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="phone" label="{{'رقم الهاتف الثابت' }}" :value="$family->phone" />
            </div>
            {{-- <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="number_of_family_members" label="{{' عدد أفراد الاسرة' }}" :value="$family->number_of_family_members" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> التغطيه الصحيه</label>
              <select name="medical_insurance">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.medical_insurance') as $key => $label)
                <option value="{{ $key }}" @if (old('medical_insurance', $family->medical_insurance)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('medical_insurance')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.select name="governorate_id" label="{{' الإقليم ' }}" :selected="$family->governorate_id" :options="$governorates" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> المدينة </label>
              <select name="city_id">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach ($cities as $city)
                <option value="{{$family->city_id }}" @if (old('city_id', $city->id) == $family->city_id) selected="selected" @endif>
                  {{ $city->name }}</option>
                @endforeach
              </select>
              @error('city_id')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <h6 style="color: #84BA3F">{{'معلومات السكن'}}</h6><br><br>
            <div class="form-group mb-3 col-md-4">
              <label class="form-label" for="exampleFormControlSelect1">ملكية السكن</label>
              <select name="housing_ownership">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.housing_ownership') as $key => $label)
                <option value="{{ $key }}" @if (old('housing_ownership', $family->housing_ownership)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('housing_ownership')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-4">
              <label class="form-label" for="exampleFormControlSelect1">نوع السكن</label>
              <select name="housing_type">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.housing_type') as $key => $label)
                <option value="{{ $key }}" @if (old('housing_type', $family->housing_type)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('housing_type')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-4">
              <label class="form-label" for="exampleFormControlSelect1">حالة السكن</label>
              <select name="housing_status">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.housing_status') as $key => $label)
                <option value="{{ $key }}" @if (old('housing_status', $family->housing_status)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('housing_status')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <h6 style="color: #84BA3F">{{'معلومات الأب'}}</h6><br><br>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_name" label="{{'اسم الأب بالعربية' }}" :value="$family->father_name" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_family_name" label="{{'نسب الأب بالعربيه' }}" :value="$family->father_family_name" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_name_in_french" label="{{'اسم الأب بالفرنسية' }}" :value="$family->father_name_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_family_name_in_french" label="{{'نسب الأب بالفرنسية' }}" :value="$family->father_family_name_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_job" label="{{'مهنة الأب' }}" :value="$family->father_job" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_id_no" label="{{'رقم البطاقة الوطنيه للأب' }}" :value="$family->father_id_no" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="father_birthdate" label="{{'تاريخ ازدياد الأب' }}" :value="$family->father_birthdate" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_address" label="{{'عنوان الأب بالعربيه' }}" :value="$family->father_address" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_address_in_french" label="{{'عنوان الأب بالفرنسية' }}" :value="$family->father_address_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_phone" label="{{'رقم هاتف الأب' }}" :value="$family->father_phone" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="father_death_date" label="{{'تاريخ وفاة الأب' }}" :value="$family->father_death_date" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="father_death_reason" label="{{'سبب وفاة الأب' }}" :value="$family->father_death_reason" />
            </div>
          </div>
          <h6 style="color: #84BA3F">{{'معلومات الأم'}}</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_name" label="{{'اسم الأم بالعربية' }}" :value="$family->mother_name" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_family_name" label="{{'نسب الأم بالعربيه' }}" :value="$family->mother_family_name" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_name_in_french" label="{{'اسم الأم بالفرنسية' }}" :value="$family->mother_name_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_family_name_in_french" label="{{'نسب الأم بالفرنسية' }}" :value="$family->mother_family_name_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_id_no" label="{{'رقم البطاقة الوطنيه للأم' }}" :value="$family->mother_id_no" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="mother_id_expire_date" label="{{'تاريخ انتهاء صلاحية البطاقة الوطنية' }}" :value="$family->mother_id_expire_date" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="mother_birth_date" label="{{'تاريخ ازدياد الأم' }}" :value="$family->mother_birth_date" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_address" label="{{'عنوان الأم بالعربيه' }}" :value="$family->mother_address" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_address_in_french" label="{{'عنوان الأم بالفرنسية' }}" :value="$family->mother_address_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_phone" label="{{'رقم هاتف الأم' }}" :value="$family->mother_phone" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_support_amount" label="{{'مبلغ الدعم للأم' }}" :value="$family->mother_support_amount" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_income" label="{{'دخل الأم' }}" :value="$family->mother_income" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">المستوى الدراسي</label>
              <select name="mother_education_level">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.mother_education_level') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_education_level', $family->mother_education_level)==$key) selected @endif>{{ $label }}</option>
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
                @foreach(config('options.mother_qualifications', $family->mother_qualifications) as $key => $label)
                <option value="{{ $key }}" @if (old('mother_qualifications', $family->mother_qualifications)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_qualifications')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل تعمل الأم ؟</label>
              <select name="does_mother_work">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('does_mother_work', $family->does_mother_work)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('does_mother_work')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="mother_working_type" label="{{'نوع العمل' }}" :value="$family->mother_working_type" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> انخراطها في الضمان الاجتماعي ؟</label>
              <select name="social_security">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('social_security', $family->social_security)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('social_security')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل تستفيد من دعم الأرامل ؟</label>
              <select name="widows_support">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('widows_support', $family->widows_support)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('widows_support')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل الأم متوفيه</label>
              <select name="mother_alive" id="aliveSelect">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('mother_alive', $family->mother_alive)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('mother_alive')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 motherAlive {{ $family->mother_death_date ? '' : 'hidden' }}">
              <x-inputs.text type="date" name="mother_death_date" label="{{'تاريخ وفاة الأم' }}" :value="$family->mother_death_date" />
            </div>
            <div class="form-group mb-3 col-md-3 motherAlive {{ $family->mother_death_reason ? '' : 'hidden' }}">
              <x-inputs.text name="mother_death_reason" label="{{'سبب وفاة الأم' }}" :value="$family->mother_death_reason" />
            </div>
          </div>
          <h6 style="color: #84BA3F">{{'معلومات المعيل'}}</h6><br>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">هل العائلة تتوفر على معيل؟</label>
              <select name="family_breadwinner" id="theSelect">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.boolean') as $key => $label)
                <option value="{{ $key }}" @if (old('family_breadwinner', $family->family_breadwinner)==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('family_breadwinner')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3 breadwinner {{ $family->breadwinner_name ? '' : 'hidden' }} ">
              <x-inputs.text name="breadwinner_name" label="{{'اسم المعيل بالعربي' }}" :value="$family->breadwinner_name" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner {{ $family->breadwinner_french_name ? '' : 'hidden' }} ">
              <x-inputs.text name="breadwinner_french_name" label="{{' اسم المعيل بالفرنسية' }}" :value="$family->breadwinner_french_name" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner {{ $family->breadwinner_family_name ? '' : 'hidden' }} ">
              <x-inputs.text name="breadwinner_family_name" label="{{'نسب المعيل بالعربيه' }}" :value="$family->breadwinner_family_name" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner {{ $family->breadwinner_family_in_french ? '' : 'hidden' }} ">
              <x-inputs.text name="breadwinner_family_in_french" label="{{'نسب المعيل بالفرنسية' }}" :value="$family->breadwinner_family_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner {{ $family->breadwinner_job ? '' : 'hidden' }} ">
              <x-inputs.text name="breadwinner_job" label="{{'مهنة المعيل' }}" :value="$family->breadwinner_job" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner {{ $family->breadwinner_id_no ? '' : 'hidden' }} ">
              <x-inputs.text name="breadwinner_id_no" label="{{' رقم البطاقة الوطنية للمعيل' }}" :value="$family->breadwinner_id_no" />
            </div>
            <div class="form-group mb-3 col-md-3  breadwinner {{ $family->breadwinner_phone ? '' : 'hidden' }} ">
              <x-inputs.text name="breadwinner_phone" label="{{' رقم هاتف المعيل' }}" :value="$family->breadwinner_phone" />
            </div>
          </div> --}}
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <x-inputs.file accept=".jpg, .jpeg, .png, .pdf" name="attachments[]" multiple label="{{'اضافة مرفقات' }}" />
            </div>
          </div>
          <button type="submit" class="button black x-small">تعديل</button>
        </form>
      </div>
      <br>

      <div class="form-group mb-3 col-md-12">
        <h6 style="color: #84BA3F">{{' المرفقات'}}</h6><br>
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
                <tr style='text-align:center;vertical-align:middle'>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $attachment->original_name }}</td>
                  <td>{{ $attachment->created_at->diffForHumans() }}</td>
                  <td>
                    <a class="btn btn-dark btn-sm" href="{{ route('admin.view_family_attachment', $attachment) }}" target="_blank" role="button"><i class="fa fa-eye"></i>&nbsp;{{ 'عرض' }}</a>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.download_family_attachment', [$family->id, $attachment->file_name]) }}" role="button"><i class="fa fa-cloud-download"></i>&nbsp;{{ 'تحميل' }}</a>
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
                        <form action="{{ route('admin.delete_family_attachment', [$family->id, $attachment->file_name] ) }}" method="post">
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
{{-- validate Inputs --}}
<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
        ignore: [],
          rules: {
            family_name: {
                  required : true,
              }, 
              income: {
                  required : true,
              }, 
              bank_account_number: {
                  required : true,
                  number : true,
              }, 
              phone: {
                  required : true,
              }, 
              number_of_family_members: {
                  required : true,
                  max : 20,
              }, 
              medical_insurance: {
                  required : true,
              }, 
              housing_ownership: {
                  required : true,
              }, 
              housing_type: {
                  required : true,
              }, 
              housing_status: {
                  required : true,
              }, 
              father_name: {
                  required : true,
              }, 
              father_family_name: {
                  required : true,
              }, 
              father_name_in_french: {
                  required : true,
              }, 
              father_family_name_in_french: {
                  required : true,
              }, 
              father_job: {
                  required : true,
              }, 
              father_id_no: {
                  required : true,
                  number : true,
              }, 
              father_birthdate: {
                  required : true,
                  date : true,
              }, 
              father_address: {
                  required : true,
              }, 
              father_address_in_french: {
                  required : true,
              }, 
              father_phone: {
                  required : true,
                  number : true,
              }, 
              mother_name: {
                required : true,
              }, 
              mother_family_name: {
                  required : true,
              }, 
              mother_name_in_french: {
                  required : true,
              }, 
              mother_family_name_in_french: {
                  required : true,
              }, 
              mother_id_no: {
                  required : true,
              }, 
              mother_id_expire_date: {
                  required : true,
                  date : true,
              }, 
              mother_birth_date: {
                  required : true,
                  date : true,
              }, 
              mother_address: {
                  required : true,
              }, 
              mother_address_in_french: {
                  required : true,
              }, 
              mother_phone: {
                  required : true,
                  number : true,
              }, 
              mother_support_amount: {
                  required : true,
                  number : true,
              }, 
              mother_income: {
                  required : true,
              }, 
              mother_education_level: {
                  required : true,
              }, 
              mother_qualifications: {
                  required : true,
              }, 
              does_mother_work: {
                  required : true,
              }, 
              social_security: {
                  required : true,
              }, 
              widows_support: {
                  required : true,
              }, 
              mother_alive: {
                  required : true,
              }, 
              governorate_id: {
                  required : true,
              }, 
              city_id: {
                  required : true,
              }, 
              family_breadwinner: {
                  required : true,
              }, 
              mother_alive: {
                  required : true,
              }, 
          },
          messages :{
            family_name: {
                  required : ' اسم العائلة  مطلوب',
              },
              income: {
                required : ' حقل الدخل مطلوب',
              },
              bank_account_number: {
                  required : '   رقم الحساب البنكى مطلوب',
                  number : 'رقم الحساب يجب أن يكون رقم'
              },
              phone: {
                  required : '   رقم الهاتف الثابت  مطلوب',
              },
              number_of_family_members: {
                  required : 'عدد أفراد الأسرة مطلوب',
                  max : 'عدد الافراد يجب ان يكون اقل من 20',
              },
              medical_insurance: {
                  required : '   حقل التغطيه الصحيه مطلوب',
              },
              governorate_id: {
                required : ' حقل الإقليم مطلوب',
              },
              city_id: {
                  required : ' حقل المدينة مطلوب',
              },
              housing_ownership: {
                  required : '   حقل ملكية السكن مطلوب',
              },
              housing_type: {
                  required : 'حقل نوع السكن مطلوب',
              },
              housing_status: {
                  required : 'حقل حالة السكن مطلوب',
              },
              father_name: {
                  required : ' اسم الأب بالعربية مطلوب',
              },
              father_family_name: {
                  required : 'نسب الأب بالعربيه مطلوب',
              },
              father_name_in_french: {
                required : ' اسم الأب بالفرنسية مطلوب',
              },
              father_family_name_in_french: {
                required : 'نسب الأب بالفرنسية مطلوب',
              },
              father_job: {
                  required : 'مهنة الأب مطلوبة',
              },
              father_id_no: {
                  required : 'رقم البطاقة الوطنيه للأب مطلوب',
                  number : 'رقم البطاقة الوطنيه للأب يجب أن يكون رقما',
              },
              father_birthdate: {
                  required : 'تاريخ ازدياد الأب مطلوب',
                  date : ' تاريخ ازدياد الأب غير صحيح',
              },
              father_address: {
                required : 'عنوان الأب بالعربيه مطلوب',
              },
              father_address_in_french: {
                required : 'عنوان الأب بالفرنسية مطلوب',
              },
              father_phone: {
                  required : 'رقم هاتف الأب مطلوب',
                  number : 'رقم الهاتف يجب أن يكون رقما',
              },
              mother_name: {
                required : ' اسم الأم بالعربية مطلوب',
              },
              mother_family_name: {
                  required :  'نسب الأم بالعربيه مطلوب',
              },
              mother_name_in_french: {
                  required : ' اسم الأم بالفرنسية مطلوب',
              },
              mother_family_name_in_french: {
                  required : 'نسب الأم بالفرنسية مطلوب',
              },
              mother_id_no: {
                  required : 'رقم البطاقة الوطنيه للأم مطلوب',
              },
              mother_id_expire_date: {
                  required : 'تاريخ انتهاء صلاحية البطاقة الوطنية مطلوب',
                  date : true,
              },
              mother_birth_date: {
                  required : 'تاريخ ازدياد الأم مطلوب',
                  date : ' تاريخ ازدياد الأم غير صحيح',
              },
              mother_address: {
                required : 'عنوان الأم بالعربيه مطلوب',
              },
              mother_address_in_french: {
                required : 'عنوان الأم بالفرنسية مطلوب',
              },
              mother_phone: {
                required : 'رقم هاتف الأم مطلوب',
                number : 'رقم الهاتف يجب أن يكون رقما',
              },
              mother_support_amount: {
                required : ' مبلغ الدعم للأم مطلوب',
                number : 'مبلغ الدعم للأم يجب أن يكون رقما',
              },
              mother_income: {
                required : 'دخل الأم مطلوب',
              },
              mother_education_level: {
                required : '  المستوى الدراسى مطلوب',
              },
              mother_qualifications: {
                required : '  نوع عمل الأم مطلوب',
              },
              does_mother_work: {
                required : ' الحقل مطلوب',
              },
              social_security: {
                required : ' الحقل مطلوب',
              },
              widows_support: {
                required : '  الحقل مطلوب',
              },
              mother_alive: {
                required : '  الحقل مطلوب',
              },
              family_breadwinner: {
                required : '  الحقل مطلوب',
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
                          url: "{{ URL::to('admin/get_cities') }}/" + governorate_id,
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