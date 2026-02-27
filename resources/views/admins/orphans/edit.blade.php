@extends('layouts.master')
@section('title','تعديل بيانات يتيم')
@section('breadcrumpTitle','تعديل بيانات يتيم')
@section('css')
<style>
  .hidden {
    display: none;
  }
</style>
@endsection

@section('breadcrump')
@parent
<li class="breadcrumb-item"><a href="{{ route('admin.orphans.index') }}" class="default-color">الأيتام</a></li>
<li class="breadcrumb-item active">تعديل يتيم</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="{{ route('admin.orphans.update', $orphan->id) }}" class="modal_style" id="myForm" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="{{ $orphan->id }}">
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="name_ar" label="{{'الإسم الشخصي بالعربية'}}" :value="$orphan->name_ar" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="name_fr" label="{{'الاسم الشخصي بالفرنسية'}}" :value="$orphan->name_fr" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="family_name_ar" label="{{'اسم العائلة بالعربية'}}" :value="$orphan->family_name_ar" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="family_name_fr" label="{{'اسم العائلة بالفرنسية'}}" :value="$orphan->family_name_fr" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text type="date" name="birth_date" label="{{'تاريخ الازدياد'}}" :value="$orphan->birth_date" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">الجنس</label>
              <select name="gender" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.gender') as $key => $label)
                <option value="{{ $key }}" {{ old('gender', $orphan->gender) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.select name="governorate_id" label="{{' الإقليم '}}" :options="$governorates" :selected="$orphan->governorate_id" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">المدينة / الجماعة</label>
              <select name="city_id" class="form-control">
                <option disabled>اختر من القائمة...</option>
                {{-- ملء المدن القادمة من الكنترولر --}}
                @foreach($cities as $id => $name)
                <option value="{{ $id }}" {{ old('city_id', $orphan->city_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="city_in_french" label="{{'اسم المدينة بالفرنسية'}}" :value="$orphan->city_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="address" label="{{'العنوان بالعربيه'}}" :value="$orphan->address" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="address_in_french" label="{{'العنوان بالفرنسية'}}" :value="$orphan->address_in_french" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="arrangement_between_brothers" label="{{'الترتيب'}}" :value="$orphan->arrangement_between_brothers" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">حالة الدخل</label>
              <select name="income_status" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.income_status') as $key => $label)
                <option value="{{ $key }}" {{ old('income_status', $orphan->income_status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="other_income" label="{{'دخل أخر'}}" :value="$orphan->other_income" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="phone" label="{{'رقم الهاتف'}}" :value="$orphan->phone" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">الفصيلة الدموية</label>
              <select name="blood_type" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.blood_type') as $key => $label)
                <option value="{{ $key }}" {{ old('blood_type', $orphan->blood_type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.select name="supervisor_id" label="{{'المشرف'}}" :options="$users" :selected="$orphan->supervisor_id" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">الحالة الصحية</label>
              <select name="health_status" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.health_status') as $key => $label)
                <option value="{{ $key }}" {{ old('health_status', $orphan->health_status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">المستوى الدراسي</label>
              <select name="academic_level" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach(config('options.academic_level') as $key => $label)
                <option value="{{ $key }}" {{ old('academic_level', $orphan->academic_level) == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="shoe_size" label="{{'قياس الحذاء'}}" :value="$orphan->shoe_size" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="clothes_size" label="{{'قياس الملابس'}}" :value="$orphan->clothes_size" />
            </div>
            @if($orphan->sponsor_id)
            <div class="form-group mb-3 col-md-3">
              <label class="form-label">الكفيل</label>
              <select name="sponsor_id" class="form-control">
                <option disabled>اختر من القائمة...</option>
                @foreach($sponsors as $id => $name)
                <option value="{{ $id }}" {{ old('sponsor_id', $orphan->sponsor_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <x-inputs.text name="orphan_sponsorship_code" label="{{'رمز اليتيم'}}" :value="$orphan->orphan_sponsorship_code" />
            </div>
            @endif
          </div>
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <x-inputs.file name="image" id="image" label="{{'تحديث الصورة الشخصية (اختياري)'}}" available_formats="jpg, jpeg, png"  accept=".jpg,.jpeg,.png" />
            </div>
            <div class="form-group mb-3 col-md-md-6">
              <label class="form-label"> </label>
              <img id="showImage" src="{{ $orphan->image ? Storage::disk('uploads')->url($orphan->image) : url('dashboard/assets/images/no_image.jpg') }}" width="80px" height="80px" class="rounded-circle avatar-lg border border-secondary"
                style="object-fit: cover;" alt="profile-image">
            </div>
          </div>
          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <x-inputs.file accept=".jpg, .jpeg, .png, .pdf" name="attachments[]" multiple label="{{'إضافة مرفقات جديدة (اختياري)'}}"  available_formats="jpg, jpeg, png, pdf"  accept=".jpg,.jpeg,.png,.pdf" />
            </div>
          </div>
          <button type="submit" class="button black x-small">حفظ التعديلات</button>
        </form>
        <hr>
        <div class="row mt-4">
          <div class="col-md-12">
            <h6 style="color: #84BA3F; font-weight: bold;"><i class="fa fa-paperclip"></i> المرفقات الحالية</h6>

            @if($orphan->attachments->count() > 0)
            <div class="table-responsive mt-3">
              <table class="table table-striped table-bordered p-0" style="text-align: center">
                <thead>
                  <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">اسم الملف</th>
                    <th scope="col">تاريخ الإنشاء</th>
                    <th scope="col">العمليات</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orphan->attachments as $attachment)
                  <tr style='text-align:center;vertical-align:middle'>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attachment->original_name }}</td>
                    <td>{{ $attachment->created_at->diffForHumans() }}</td>
                    <td>
                      <a class="btn btn-dark btn-sm" href="{{ route('admin.view_orphan_attachment', $attachment) }}" target="_blank" role="button">
                        <i class="fa fa-eye"></i> {{ 'عرض' }}
                      </a>
                      <a class="btn btn-success btn-sm" href="{{ route('admin.download_orphan_attachment', $attachment) }}" role="button">
                        <i class="fa fa-cloud-download"></i> {{ 'تحميل' }}
                      </a>
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete_img{{ $attachment->id }}" title="حذف">
                        <i class="fa fa-trash"></i> {{'حذف'}}
                      </button>
                    </td>
                  </tr>

                  <!-- Modal Delete Attachment -->
                  <div class="modal fade" id="Delete_img{{ $attachment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('admin.delete_orphan_attachment', $attachment) }}" method="post">
                            @csrf
                            {{'هل أنت متأكد من حذف المرفق ؟' }}
                            <input type="hidden" name="id" value="{{ $attachment->id }}">
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
            @else
            <div class="alert alert-info text-center">لا توجد مرفقات لهذا اليتيم حالياً.</div>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
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

<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
        ignore: [],
          rules: {
            name_ar: { required : true }, 
            name_fr: { required : true }, 
            family_name_ar: { required : true }, 
            family_name_fr: { required : true },
            birth_date: { required : true }, 
            gender: { required : true }, 
            governorate_id: { required : true }, 
            city_id: { required : true }, 
            city_in_french: { required : true }, 
            address: { required : true }, 
            address_in_french: { required : true }, 
            arrangement_between_brothers: { required : true }, 
            income_status: { required : true }, 
            other_income: { required : true }, 
            phone: { required : true }, 
            blood_type: { required : true }, 
            supervisor_id: { required : true }, 
            health_status: { required : true }, 
            academic_level: { required : true },
            shoe_size: { required : true },
            clothes_size: { required : true },
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
          var governorate_id = $(this).val(); 
          if (governorate_id) {
              $.ajax({
                  url: "{{ route('admin.get_cities', ':id') }}".replace(':id', governorate_id),
                  type: "GET",
                  dataType: "json",
                  success: function(data) {
                      $('select[name="city_id"]').empty(); 
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