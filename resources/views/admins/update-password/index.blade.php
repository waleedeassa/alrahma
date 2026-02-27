@extends('layouts.master')
@section('title',"تغيير كلمة المرور")
@section('breadcrumpTitle', "تغيير كلمة المرور")
@section('breadcrump')
@parent
<li class="breadcrumb-item active">تغيير كلمة المرور</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
          @if ($errors->password->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
              @foreach ($errors->password->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
          </div>
          @endif
          <form method="POST" action="{{route('admin.update.password')}}" class="modal_style" id="myForm">
            @csrf
              <div class="col-12 col-lg-6 my-2">
                <div class="col-12 p-2 form-group">
                  <div class=" col-12 pt-3">
                    <x-inputs.text name="old_password" type="password" label="كلمة المرور الحالية" />
                  </div>
                </div>

                <div class="col-12 p-2 form-group ">
                  <div class="col-12 pt-3">
                    <x-inputs.text name="password" id="password" type="password" label="كلمة المرور الجديدة" />
                  </div>
                </div>
                <div class="col-12 p-2 form-group ">
                  <div class=" col-12 pt-3">
                    <x-inputs.text name="password_confirmation" id="password_confirmation" type="password" label="تأكيد كلمة المرور الجديدة" />
                  </div>
                </div>

                <div class="col-12 p-2">
                  <div class="col-12 pt-3">
                    <button type="submit" class="button black x-small"> <i class="fa fa-floppy-o"></i>&nbsp; تحديث كلمة المرور</button>
                  </div>
                </div>
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
            old_password: {
                  required : true,
              }, 
              password: {
                  required : true,
              }, 
              password_confirmation: {
                  required : true,
                  equalTo : "#password",
              }, 
          },
          messages :{
            old_password: {
              required : 'كلمة المرور الحالية مطلوبة',
              },
              password: {
                required : 'كلمة المرور الجديدة مطلوبة',
              },
              password_confirmation: {
                  required : 'تأكيد كلمة المرور الجديدة مطلوبة ',
                  equalTo : 'تأكيد كلمة المرور غير متطابقة مع كلمة المرور الجديدة',
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
@endpush()
