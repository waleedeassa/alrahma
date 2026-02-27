@extends('layouts.auth.login')
@section('title', "تغيير كلمة المرور")
@section('form_title',"تغيير كلمة المرور")
@section('form')
<form method="POST" id="myForm" action="{{ route('sponsor.reset.password') }}" class=" modal_style">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <div class="login-fancy pb-40 clearfix">
    <h3 class="mb-30">تغيير كلمة المرور</h3>
    <div class="section-field mb-20 form-group">
      <label class="mb-10" for="name">البريد الالكترونى</label>
      <input id="email" name="email" class="web form-control" type="text" value="{{ $email }}" readonly>
      @error('email')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="section-field mb-20 form-group">
      <label class="mb-10" for="name">كلمة المرور الجديدة</label>
      <input id="password" name="password" class="web form-control" type="password" autocomplete="new-password">
      @error('password')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="section-field mb-20 form-group">
      <label class="mb-10" for="name">تأكيد كلمة المرور الجديدة</label>
      <input id="password_confirmation" name="password_confirmation" class="web form-control" type="password">
      @error('password_confirmation')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <button class="button black x-small"><span>تعديل كلمة المرور</span></button>
  </div>
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
                  minlength : 8,
              }, 
              password_confirmation: {
                  required : true,
                  equalTo : "#password",
              }, 
          },
          messages :{
              email: {
                  required : 'البريد الالكترونى مطلوب',
                  email : 'البريد الالكترونى غير صحيح',
              },
              password: {
                  required : 'كلمة المرور الجديدة مطلوبة',
                  minlength : 'كلمة المرور الجديدة يجب ان تكون على الاقل 8 حروف وأرقام',
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
@endpush