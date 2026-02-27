@extends('layouts.master')
@section('title', 'الأقاليم')
@section('breadcrumpTitle', 'الأقاليم')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">الأقاليم</li>
@endsection
@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <button type="button" class="button black" data-bs-target="#createNewGovernorate" data-bs-toggle="modal"><i class="fa fa-plus"></i>&nbsp; اضافة اقليم</button>
        <br>
        <br>
        <div class="table-responsive" id="print2">
          <table id="yajra_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>عدد المدن </th>
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
@include('admins.governorates._create')
@include('admins.governorates._edit')
@endsection
@push('js')
<script>
  // Initialize DataTable
  var lang = '{{ App::getLocale() }}';
  $('#yajra_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("admin.get-governorates") }}',
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
      {data: 'name', name: 'name'}, 
      {data: 'cities_count', name: 'cities_count', orderable: false, searchable: false}, 
      {data: 'created_at', name: 'created_at'}, 
      {data: 'action', name: 'action', orderable: false, searchable: false},
      {data: 'id', name: 'id', visible: false},
    ],
    order: [[5, 'DESC']],
  });

  // Create Governorate Modal
  $('#createNewGovernorate').on('show.bs.modal', function () {
    $('.text-danger').text('');
    $('#createGovernorate')[0].reset();
  });

  $('#createGovernorate').on('input change', 'input, select', function () {
    const inputName = $(this).attr('name');
    if (inputName) {
      const sanitizedKey = inputName.replace(/\./g, '_');
      $('#error_' + sanitizedKey).text('');
    }
  });

  $('#createGovernorate').on('submit', function(e) {
    e.preventDefault();
    var currentPage = $('#yajra_table').DataTable().page();
    
    $.ajax({
      url: "{{ route('admin.governorates.store') }}",
      method: 'post',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.status === 'success') {
          $('#createGovernorate')[0].reset();
          $('.text-danger').text('');
          $('#yajra_table').DataTable().page(currentPage).draw(false);
          $('#createNewGovernorate').modal('hide');
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
  // Edit Governorate
  $(document).on("click", ".edit_governorate", function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');

    $("#id").val(id);
    $("#name").val(name);

    $(".text-danger").text("");
    $("#editGovernorateModal").modal("show");
  });

  // Update Governorate
  $('#updateGovernorate').on('submit', function(e) {
    e.preventDefault();
    var id = $('#id').val();
    var currentPage = $('#yajra_table').DataTable().page();
    
    $.ajax({
      url: "{{ route('admin.governorates.update', 'id') }}".replace('id', id),
      method: 'post',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.status === 'success') {
          $('#updateGovernorate')[0].reset();
          $('.text-danger').text('');
          $('#yajra_table').DataTable().page(currentPage).draw(false);
          $('#editGovernorateModal').modal('hide');
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

  $('#editGovernorateModal').on('show.bs.modal', function() {
    $('.text-danger').text('');
  });

  // Delete Governorate
  $(document).on('submit', '#deleteGovernorate', function(e) {
    e.preventDefault();
    var form = $(this);
    var modalId = form.closest('.modal').attr('id');
    var governorateId = form.find('input[name="id"]').val();
    var token = form.find('input[name="_token"]').val();
    var currentPage = $('#yajra_table').DataTable().page();
    var locale = '{{ app()->getLocale() }}';

    $.ajax({
      url: '/admin/governorates/' + governorateId,
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
@endpush