@extends('layouts.master')
@section('title','اضافة صلاحيات المسؤول')
@section('breadcrumpTitle','اضافة صلاحيات المسؤول')
@section('breadcrump')
@parent
<li class="breadcrumb-item "><a href="{{ route('admin.role-permissions.index') }}" class="default-color">
  صلاحيات المسؤولين</a></li>
<li class="breadcrumb-item active">اضافة صلاحيات المسؤول</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <form action="{{ route('admin.role-permissions.store') }}"  class="modal_style" id="myForm" method="POST">
          @csrf
          <div class="form-group mb-3 col-6">
            <x-inputs.select name="role_id" label="{{' نوع المسؤول '  }}" :options="$roles" />
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
              <div class="form-check">
                <x-inputs.checkbox name="" :label="$group->group_name" for="Check1" />
              </div>
            </div>

            @php
            // $permissions = AddRolePermissionsController::getPermissionsByGroupName($group->group_name)
            $permissions = App\Models\User::getPermissionsByGroupName($group->group_name);
            @endphp

            <div class="form-group mb-3 col-md-9">
              @foreach ( $permissions as $permission)
              <div class="form-check">
                <x-inputs.checkbox name="permission[]" id="check{{ $permission->id }}" :value="$permission->id" :label="$permission->name" />
              </div>
              @endforeach
              <br>
            </div>

          </div>

          @endforeach

          <button type="submit" class="button black x-small">اضافة</button>
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

<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
            role_id: {
                  required : true,
              }, 
          },
          messages :{
            role_id: {
              required : 'نوع المسؤول مطلوب',
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