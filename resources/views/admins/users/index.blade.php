@extends('layouts.master')
@section('title', 'المستخدمين')
@section('breadcrumpTitle', 'المستخدمين')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">المستخدمين</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <button type="button" class="button black" data-bs-target="#createNewUser" data-bs-toggle="modal"><i class="fa fa-plus"></i>&nbsp; اضافة مستخدم</button>
        <br>
        <br>
        <div class="table-responsive" id="print2">
          <table id="yajra_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th>الاسم الشخصى</th>
                <th>اسم العائلة</th>
                <th>البريد الالكتروني</th>
                <th>الصفة</th>
                <th>الحالة</th>
                <th>رقم الهاتف</th>
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
@include('admins.users._create')
@include('admins.users._edit')
@endsection
@push('js')
<script>
  // Initialize DataTable
  var lang = '{{ App::getLocale() }}';
  $('#yajra_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("admin.get-users") }}',
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
      {data: 'name', name: 'name'}, 
      {data: 'family_name', name: 'family_name'}, 
      {data: 'email', name: 'email'}, 
      {data: 'role', name: 'role', orderable: false, searchable: false}, 
      {data: 'status',name: 'status'},
      {data: 'phone', name: 'phone'}, 
      {data: 'action', name: 'action', orderable: false, searchable: false},
      {data: 'id', name: 'id', visible: false},
    ],
    order: [[8, 'DESC']],
  });

  // Create User Modal
  $('#createNewUser').on('show.bs.modal', function () {
    $('.text-danger').text('');
    $('#createUser')[0].reset();
  });

  $('#createUser').on('input change', 'input, select', function () {
    const inputName = $(this).attr('name');
    if (inputName) {
      const sanitizedKey = inputName.replace(/\./g, '_');
      $('#error_' + sanitizedKey).text('');
    }
  });

  $('#createUser').on('submit', function(e) {
    e.preventDefault();
    var currentPage = $('#yajra_table').DataTable().page();
    
    $.ajax({
      url: "{{ route('admin.users.store') }}",
      method: 'post',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.status === 'success') {
          $('#createUser')[0].reset();
          $('.text-danger').text('');
          $('#yajra_table').DataTable().page(currentPage).draw(false);
          $('#createNewUser').modal('hide');
          toastr.success(data.message);
        } else if (data.status === 'error') {
          toastr.error(data.message);
        }
      },
      error: function(data) {
        if (data.responseJSON.errors) {
          $('.text-danger').text('');
          $.each(data.responseJSON.errors, function(key, value) {
            const sanitizedKey = key.replace(/\./g, '_');
            $('#error_' + sanitizedKey).text(value[0]);
          });
        }
      }
    });
  });
  // Edit User
  $(document).on("click", ".edit_user", function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    var family_name = $(this).data('family_name');
    var email = $(this).data('email');
    var phone = $(this).data('phone');
    var role_id = $(this).data('role_id');
    var status = $(this).data('status');
    // alert(role_id);  
    $("#id").val(id);
    $("#name").val(name);
    $("#family_name").val(family_name);
    $("#email").val(email);
    $("#phone").val(phone);
    $("#editUserModal #role_id").val(role_id).trigger('change');
    $("#status").val(status);

    $(".text-danger").text("");
    $("#editUserModal").modal("show");
  });

  // Update User
  $('#updateUser').on('submit', function(e) {
    e.preventDefault();
    var id = $('#id').val();
    var currentPage = $('#yajra_table').DataTable().page();
    
    $.ajax({
      url: "{{ route('admin.users.update', 'id') }}".replace('id', id),
      method: 'post',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.status === 'success') {
          $('#updateUser')[0].reset();
          $('.text-danger').text('');
          $('#yajra_table').DataTable().page(currentPage).draw(false);
          $('#editUserModal').modal('hide');
          toastr.success(data.message);
        } else {
          toastr.error(data.message);
        }
      },
      error: function(data) {
        if (data.responseJSON.errors) {
          $('.text-danger').text('');
          $.each(data.responseJSON.errors, function(key, value) {
            const sanitizedKey = key.replace(/\./g, '_');
            $('#edit_error_' + sanitizedKey).text(value[0]);
          });
        }
      }
    });
  });

  $('#editUserModal').on('show.bs.modal', function() {
    $('.text-danger').text('');
  });

  // Delete User
  $(document).on('submit', '#deleteUser', function(e) {
    e.preventDefault();
    var form = $(this);
    var modalId = form.closest('.modal').attr('id');
    var userId = form.find('input[name="id"]').val();
    var token = form.find('input[name="_token"]').val();
    var currentPage = $('#yajra_table').DataTable().page();
    var locale = '{{ app()->getLocale() }}';

    $.ajax({
      url: '/admin/users/' + userId,
      type: 'DELETE',
      data: {
        _token: token,
      },
      success: function(data) {
        if (data.status === 'success') {
          toastr.success(data.message);
          $('#yajra_table').DataTable().page(currentPage).draw(false);
          $('#' + modalId).modal('hide');
          $('#' + modalId).on('hidden.bs.modal', function() {
            $(this).remove();
          });
        } else {
          toastr.error(response.message || 'Deletion error occurred');
        }
      },
      error: function(xhr) {
        toastr.error(xhr.responseJSON?.message || 'Unexpected error occurred');
      }
    });
  });
</script>
{{-- change user status --}}
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $(document).on('change', '.statusCheckbox', function () {
      var currentPage = $('#yajra_table').DataTable().page();
      var id = $(this).data('id'); 
      var status = $(this).is(':checked') ? 1 : 0; 
      var url = "{{ route('admin.users.status.change', ['id' => ':id']) }}";
      url = url.replace(':id', id);

      $.ajax({
          url: url,
          type: 'POST', 
          data: {
              status: status 
          },
          success: function (response) {
              if (response.status === 'success') {
                  toastr.success(response.message); 
                  $('#yajra_table').DataTable().page(currentPage).draw(false);
              } else {
                  toastr.error(response.message); 
              }
          },
          error: function (xhr) {
              var checkbox = $('.statusCheckbox[data-id="' + id + '"]');
              checkbox.prop('checked', !status);
              if (xhr.responseJSON && xhr.responseJSON.message) {
                  toastr.error(xhr.responseJSON.message);
              } else {
                  toastr.error('An unexpected error occurred.');
              }
          }
      });
  });
</script>
@endpush