@extends('layouts.master')
@section('title','تعديل صلاحيات المسؤول')
@section('breadcrumpTitle','تعديل صلاحيات المسؤول')
@section('breadcrump')
@parent
<li class="breadcrumb-item "><a href="{{ route('admin.role-permissions.index') }}" class="default-color">
  صلاحيات المسؤولين</a></li>
<li class="breadcrumb-item active">تعديل صلاحيات المسؤول</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <form action="{{ route('admin.role-permissions.update',$role->id) }}" id="myForm" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group mb-3 col-6">
            <h4> تعديل صلاحية : {{ $role->name }}</h4>
          </div>

          <div class="form-group mb-3 col-md-3">
            <div class="form-check">
              <x-inputs.checkbox name="" label="كل الصلاحيات" for="checkAll" id="checkAll" />
            </div>
          </div>
          <br>

          @foreach ( $permission_groups as $group)


          <div class="row">
            <div class="form-group mb-3 col-md-3">
              @php
              $permissions = App\Models\User::getPermissionsByGroupName($group->group_name);
              @endphp
              <div class="form-check">
                <input type="checkbox" {{App\Models\User::roleHasPermissions($role,$permissions)  ? 'checked' : ''}} >
                <label  class="form-check-label" for= "check"  >
                  {{$group->group_name}}  
              </label>
              </div>
            </div>


            <div class="form-group mb-3 col-md-9">
              @foreach ( $permissions as $permission)
              <div class="form-check">
                <input type="checkbox" name="permission[]" id="check{{ $permission->id }}" value="{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}} >
                <label  class="form-check-label" for= "check{{ $permission->id }}"  >
                  {{$permission->name }}  
              </label>
              </div>
              @endforeach
              <br>
            </div>

          </div>

          @endforeach

          <button type="submit" class="button black x-small">تعديل</button>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection

@push('js')

<script type="text/javascript">
  $('#checkAll').click(function(){
     if ($(this).is(':checked')) {
         $('input[type = checkbox]').prop('checked',true);
     }else{
          $('input[type = checkbox]').prop('checked',false);
     }
  });

</script>   

{{-- <script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              name: {
                  required : true,
              }, 
          },
          messages :{
              name: {
                  required : 'اسم الصلاحية مطلوب',
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
  
</script> --}}
@endpush