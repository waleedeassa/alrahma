@extends('layouts.master')
@section('title', "المسؤولين")
@section('breadcrumpTitle',"المسؤولين")

@section('breadcrump')
@parent
<li class="breadcrumb-item active">المسؤولين</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        {{-- @can('اضافة مسؤول') --}}
        <button type="button" class="button black" data-bs-toggle="modal" data-bs-target="#createRoleModal">
          <i class="fa fa-plus"></i>&nbsp; اضافة مسؤول
        </button>
        {{-- @endcan --}}
        <br><br>
        <div class="table-responsive">
          <table id="roles_datatable" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th>اسم المسؤول</th>
                <th>تاريخ الاضافة</th>
                <th>العمليات</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@include('admins.roles._create')
@include('admins.roles._edit')
@endsection
@push('js')
<script>
  $(document).ready(function() {
    var table = $('#roles_datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ route("admin.get-roles") }}',
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false}, 
        {data: 'name', name: 'name'}, 
        {data: 'created_at', name: 'created_at'}, 
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ],
      order: [[2, 'desc']]
    });
    // Create Role Modal
    $('#createRoleForm').on('submit', function(e) {
      e.preventDefault();
      $('.text-danger').text('');

      $.ajax({
        url: "{{ route('admin.roles.store') }}",
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(data) {
          if (data.status === 'success') {
            $('#createRoleModal').modal('hide');
            $('#createRoleForm')[0].reset();
            table.draw();
            toastr.success(data.message);
          }
        },
        error: function(data) {
          if (data.status === 422) {
            var errors = data.responseJSON.errors;
            $.each(errors, function(key, value) {
              $('#error_' + key).text(value[0]);
            });
          } else {
            toastr.error('حدث خطأ ما!');
          }
        }
      });
    });
    // Edit role
    $(document).on('click', '.edit_role', function() {
      var id = $(this).data('id');
      var name = $(this).data('name');

      $('#edit_id').val(id);
      $('#edit_name').val(name);

      $('.text-danger').text('');
      $('#editRoleModal').modal('show');
    });

    $('#updateRoleForm').on('submit', function(e) {
      e.preventDefault();
      var id = $('#edit_id').val();

      $.ajax({
        url: "/admin/roles/" + id,
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(data) {
          if (data.status === 'success') {
            $('#editRoleModal').modal('hide');
            table.draw(false);
            toastr.success(data.message);
          }
        },
        error: function(data) {
          if (data.status === 422) {
            var errors = data.responseJSON.errors;
            $.each(errors, function(key, value) {
              $('#edit_error_' + key).text(value[0]);
            });
          } else {
            toastr.error('حدث خطأ ما!');
          }
        }
      });
    });
    // Delete role
    $(document).on('submit', '.deleteRoleForm', function(e) {
      e.preventDefault();
      
      var form = $(this);
      var modalId = form.closest('.modal').attr('id');
      var roleId = form.find('input[name="id"]').val();
      var token = form.find('input[name="_token"]').val();
      var currentPage = $('#roles_datatable').DataTable().page();
      var locale = '{{ app()->getLocale() }}';

      $.ajax({
        url: '/admin/roles/' + roleId, 
        type: 'DELETE',
        data: {
          _token: token,
       
        },
        success: function(data) {
          if (data.status === 'success') {
            toastr.success(data.message);
            $('#roles_datatable').DataTable().page(currentPage).draw(false);
            $('#' + modalId).modal('hide');
            $('#' + modalId).on('hidden.bs.modal', function() {
              $(this).remove();
            });
          } else {
            toastr.error(data.message || 'Deletion error occurred');
          }
        },
        error: function(xhr) {
          toastr.error(xhr.responseJSON?.message || 'Unexpected error occurred');
        }
      });
    });
  });
</script>
@endpush
