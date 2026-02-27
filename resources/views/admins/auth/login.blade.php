@extends('layouts.auth.login')
@section('title', "تسجيل دخول الادمن")
@section('form_title',"تسجيل دخول الادمن")
@section('form')

<form method="POST" action="{{ route('admin.check') }}" id="myForm" class="modal_style"  autocomplete="off">
  @csrf
  <div class="section-field mb-20  form-group">
    <label class="mb-10" for="name"> البريد الالكترونى</label>
    <input  type="email" name="email" class="web form-control" type="text" >
    @error('email')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>
  <div class="section-field mb-20 form-group">
    <label class="mb-10" for="Password"> كلمة المرور </label>
    <input  class="Password form-control" type="password"  name="password">
    @error('password')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <button class="button btn-orange" style="background: #ED982A;border-color:#ED982A;color:#000;margin:auto;font-weight:bold;display:block;width:200px;margin-top:40px;font-size:18px"><span> <i class="fa fa-check"></i> تسجيل الدخول</span></button>
  {{-- <a href="{{ route('home') }}" class="button btn-orange" style="background: #ED982A;border-color:#ED982A;color:#000;margin:auto;font-weight:bold;display:block;width:200px;margin-top:40px;font-size:18px"><span><i class="fa fa-arrow-left"></i> رجوع </span></a> --}}
  <p style="color: #000; text-align: center; margin-bottom: 10px; margin-top: 15px; font-size: 15px">
    <a href="{{ route('admin.forget.password.form') }}">هل نسيت كلمة المرور ؟</a>
  </p>
  
  <br>
</form>
@endsection

@push('js')
<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              email: {
                  required : true,
                  email : true,
              }, 
              password: {
                  required : true,
              }, 
          },
          messages :{
              email: {
                  required : "{{ __('factories.Email is required') }}",
                  email : "{{ __('factories.Invalid email') }}",
              },
              password: {
                  required : "{{ __('factories.Password required') }}",
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