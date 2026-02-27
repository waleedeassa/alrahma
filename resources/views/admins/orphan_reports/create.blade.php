@extends('layouts.master')
@section('title', 'اضافة تقرير اليتيم ')
@section('breadcrumpTitle','اضافة تقرير اليتيم ')
@section("breadcrump")
@parent
<li class="breadcrumb-item "><a href="{{route('admin.orphans.index') }}" class="default-color">
    الأيتام</a></li>
<li class="breadcrumb-item active">اضافة تقرير اليتيم</li>
@endsection

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
        <form action="{{ route('admin.orphan-report.store') }}" id="myForm" method="POST" class="modal_style" autocomplete="off" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="orphan_id" value="{{ $orphan->id }}">
          <h6 style="color: #84BA3F; margin-top: 10px; margin-bottom: 20px;">البيانات الأساسية</h6>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="name" label="{{'اسم اليتيم' }}" value="{{ $orphan->name_ar }}" readonly />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="family_name" label="{{'اسم العائلة' }}" value="{{ $orphan->family_name_ar }}" readonly />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الحالة الصحية</label>
              <select name="health_status">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.report_health_status') as $key => $label)
                <option value="{{ $key }}" @if (old('health_status')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('health_status')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> مدة الوصول لأقرب طبيب / مستشفى</label>
              <select name="going_to_nearest_doctor_or_hospital_time">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.going_to_nearest_doctor_or_hospital_time') as $key => $label)
                <option value="{{ $key }}" @if (old('going_to_nearest_doctor_or_hospital_time')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('going_to_nearest_doctor_or_hospital_time')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <h6 style="color: #84BA3F; margin-top: 10px; margin-bottom: 20px;">البيانات التعليمية</h6>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">التعليم</label>
              <select name="education">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.academic_level') as $key => $label)
                <option value="{{ $key }}" @if (old('education')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('education')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="school_name" label="اسم المؤسسة التعليمية" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الذهاب للمدرسة</label>
              <select name="going_to_school_by">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.going_to_school_by') as $key => $label)
                <option value="{{ $key }}" @if (old('going_to_school_by')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('going_to_school_by')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">مدة الوصول لأقرب مدرسة</label>
              <select name="going_to_nearest_school_time">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.going_to_nearest_school_time') as $key => $label)
                <option value="{{ $key }}" @if (old('going_to_nearest_school_time')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('going_to_nearest_school_time')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> المادة المفضلة</label>
              <select name="preferred_subject">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.preferred_subject') as $key => $label)
                <option value="{{ $key }}" @if (old('preferred_subject')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('preferred_subject')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">المادة الغير مفضلة</label>
              <select name="unpreferred_subject">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.unpreferred_subject') as $key => $label)
                <option value="{{ $key }}" @if (old('unpreferred_subject')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('unpreferred_subject')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="first_term_average" label="المعدل الدراسي (الدورة الأولى)" inputmode="decimal" pattern="[0-9,]+" placeholder="مثال: 7,50" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="second_term_average" label="المعدل الدراسي (الدورة الثانية)" inputmode="decimal" pattern="[0-9,]+" placeholder="مثال: 8,25" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> التقدم الدراسى </label>
              <select name="school_progress">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.school_progress') as $key => $label)
                <option value="{{ $key }}" @if (old('school_progress')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('school_progress')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">قرار نهاية السنة</label>
              <select name="end_year_decision">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.end_year_decision') as $key => $label)
                <option value="{{ $key }}" @selected(old('end_year_decision')==$key)>
                  {{ $label }}
                </option>
                @endforeach
              </select>
              @error('end_year_decision')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">التغيرات على المستوى الدراسي</label>
              <select name="educational_level_changes">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.educational_level_changes') as $key => $label)
                <option value="{{ $key }}" @selected(old('educational_level_changes')==$key)>
                  {{ $label }}
                </option>
                @endforeach
              </select>
              @error('educational_level_changes')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <h6 style="color: #84BA3F; margin-top: 10px; margin-bottom: 20px;">البيانات الشخصية والمعيشية</h6>
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الشخصية</label>
              <select name="personal">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.personal') as $key => $label)
                <option value="{{ $key }}" @if (old('personal')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('personal')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">يود أن يصبح</label>
              <select name="like_to_become">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.like_to_become') as $key => $label)
                <option value="{{ $key }}" @if (old('like_to_become')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('like_to_become')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الهوايات</label>
              <select name="hobbies">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.hobbies') as $key => $label)
                <option value="{{ $key }}" @if (old('hobbies')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('hobbies')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الطعام المفضل</label>
              <select name="favorite_food">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.favorite_food') as $key => $label)
                <option value="{{ $key }}" @if (old('favorite_food')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('favorite_food')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الطعام الأساسى</label>
              <select name="basic_food">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.basic_food') as $key => $label)
                <option value="{{ $key }}" @if (old('basic_food')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('basic_food')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
                        <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> جودة السكن </label>
              <select name="quality_of_housing">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.quality_of_housing') as $key => $label)
                <option value="{{ $key }}" @if (old('quality_of_housing')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('quality_of_housing')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> مكان السكن </label>
              <select name="dwelling_place">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.dwelling_place') as $key => $label)
                <option value="{{ $key }}" @if (old('dwelling_place')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('dwelling_place')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1"> نوع المسكن </label>
              <select name="type_of_dwelling">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.type_of_dwelling') as $key => $label)
                <option value="{{ $key }}" @if (old('type_of_dwelling')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
              @error('type_of_dwelling')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group mb-3 col-md-12">
              <x-inputs.text name="supervisor_notes" label="{{'ملاحظات المشرف' }}" />
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
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              health_status: {
                  required : true,
              }, 
              going_to_nearest_doctor_or_hospital_time: {
                  required : true,
              }, 
              education: {
                  required : true,
              }, 
              going_to_school_by: {
                  required : true,
              }, 
              going_to_nearest_school_time: {
                  required : true,
              }, 
              preferred_subject: {
                  required : true,
              }, 
              unpreferred_subject: {
                  required : true,
              }, 
              personal: {
                  required : true,
              }, 
              like_to_become: {
                  required : true,
              }, 
              school_progress: {
                  required : true,
              }, 
              quality_of_housing: {
                  required : true,
              }, 
              dwelling_place: {
                  required : true,
              }, 
              type_of_dwelling: {
                  required : true,
              }, 
              hobbies: {
                  required : true,
              }, 
              favorite_food: {
                  required : true,
              }, 
              basic_food: {
                  required : true,
              }, 
          },
          messages :{
              health_status: {
                required : ' الحقل مطلوب',
              },
              going_to_nearest_doctor_or_hospital_time: {
                required : ' الحقل مطلوب',
              },
              education: {
                required : ' الحقل مطلوب',
              },
              going_to_school_by: {
                required : ' الحقل مطلوب',
              },
              going_to_nearest_school_time: {
                required : ' الحقل مطلوب',
              },
              preferred_subject: {
                required : ' الحقل مطلوب',
              },
              unpreferred_subject: {
                required : ' الحقل مطلوب',
              },
              personal: {
                required : ' الحقل مطلوب',
              },
              like_to_become: {
                required : ' الحقل مطلوب',
              },
              school_progress: {
                required : ' الحقل مطلوب',
              }, 
              quality_of_housing: {
                required : ' الحقل مطلوب',
              }, 
              dwelling_place: {
                required : ' الحقل مطلوب',
              }, 
              type_of_dwelling: {
                required : ' الحقل مطلوب',
              },
              hobbies: {
                required : ' الحقل مطلوب',
              },
              favorite_food: {
                required : ' الحقل مطلوب',
              },
              basic_food: {
                required : ' الحقل مطلوب',
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