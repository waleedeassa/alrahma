@extends('layouts.master')
{{-- @extends('dashboard_layouts.master') --}}
@section('title','اضافة صلاحية')
@section('breadcrumpTitle','اضافة صلاحية')
@section('breadcrump')
@parent
<li class="breadcrumb-item "><a href="{{ route('admin.permissions.index') }}" class="default-color">
    الصلاحيات </a></li>
<li class="breadcrumb-item active">اضافة صلاحية</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <form action="{{ route('admin.permissions.store') }}"  class="modal_style" id="myForm" method="POST">
          @csrf
          <div class="form-group mb-3 col-6">
            <x-inputs.text name="name" label="{{'اسم الصلاحية' }}" id="formGroupExampleInput" />
          </div>
          <div class="form-group mb-3 col-6">
            <x-inputs.select name="group_name" label="{{' اسم المجموعه '  }}" :options="$groups" />
          </div>
          <button type="submit" class="button black x-small">اضافة</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              name: {
                  required : true,
              }, 
              group_name: {
                  required : true,
              }, 
          },
          messages :{
              name: {
                  required : 'اسم الصلاحية مطلوب',
              },
              group_name: {
                  required : 'اسم المجموعه مطلوب',
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
@endsection