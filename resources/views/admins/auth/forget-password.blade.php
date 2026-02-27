@extends('layouts.auth.login')
@section('title', "اعادة تعيين كلمة المرور")
@section('form_title',"اعادة تعيين كلمة المرور")

@section('form')
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
<form method="POST" id="myForm" action="{{ route('admin.forget.password.create') }}"  class=" modal_style">
  @csrf
  <div class="login-fancy pb-40 clearfix">
    <h3 class="mb-30">  اعادة تعيين كلمة المرور</h3>
    <div class="section-field mb-20 form-group">
      <label class="mb-10" for="name">البريد الالكترونى</label>
      <input id="email" name="email" class="web form-control" type="text" >
      @error('email')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <button class="button black x-small"><span> إرسال رابط تغيير كلمة المرور</span></button>
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
          },
          messages :{
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
@endpush