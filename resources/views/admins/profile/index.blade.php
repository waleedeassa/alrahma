@extends('layouts.master')
@section('title', 'الملف الشخصى')
@section('breadcrumpTitle','الملف الشخصى')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">الملف الشخصى </li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card">
      <div class="card-body">
        <form method="post" action="{{ route('admin.profile.update') }}" id="myForm" class="modal_style" enctype="multipart/form-data">
          @csrf
          <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>معلومات المستخدم</h5>
          <div class="row row-align-end ">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <x-inputs.text name="name" label="اسم المستخدم" :value="$user->name" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <x-inputs.text name="family_name" label="اسم العائلة" :value="$user->family_name" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <x-inputs.text name="email" label="البريد الالكترونى" :value="$user->email" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <x-inputs.text name="phone" label="رقم الهاتف" :value="$user->phone" />
              </div>
            </div> 
            <div class="col-md-6">
              <div class="mb-3">
                <label for="example-fileinput" class="form-label">الصورة</label>
                <input type="file" accept=".jpg, .jpeg, .png" name="photo" id="image" class="form-control">
                @error('photo')
                <div style="color: red;">{{ $message }}</div>
                @enderror
              </div>
            </div> 
            <div class="col-md-6">
              <div class="mb-3">
                <label for="example-fileinput" class="form-label"> </label>
                <img id="showImage" src="{{ $user->photo_url}} " width="80px" height="80px" class="rounded-circle avatar-lg border border-secondary" alt="profile-image">
              </div>
            </div>
          </div>
          <div class="">
            <button type="submit" class="button black x-small"> <i class="fa fa-floppy-o"></i>&nbsp; تعديل</button>
            <a href="{{ url()->previous() }}" class="button black x-small"> <i class="fa fa-arrow-right"></i>&nbsp; تراجع</a>
          </div>
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
              name: {
                  required : true,
              }, 
              email: {
                  required : true,
                  email : true,
              }, 
          },
          messages :{
              name: {
                required : 'الاسم مطلوب',
              },
              email: {
                  required : 'البريد الالكترونى مطلوب',
                  email : 'البريد الالكترونى غير صحيح',
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
@endpush