@extends('layouts.master')
@section('title', 'برامج الدعم')
@section('breadcrumpTitle', 'برامج الدعم')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">برامج الدعم</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <button type="button" class="button black" data-bs-target="#createNewSupportProgram" data-bs-toggle="modal">
          <i class="fa fa-plus"></i>&nbsp; إضافة برنامج دعم
        </button>
        <br><br>
        <div class="table-responsive">
          <table id="programs_table" class="table table-striped table-bordered p-0" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th>اسم البرنامج</th>
                <th>تاريخ الإضافة</th>
                <th>العمليات</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@include('admins.support_programs._create')
@include('admins.support_programs._edit')

@endsection

@push('js')
<script>
  // Initialize DataTable
  var lang = '{{ App::getLocale() }}';
  $('#programs_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("admin.get-support-programs") }}',
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
      {data: 'name', name: 'name'}, 
      {data: 'created_at', name: 'created_at'}, 
      {data: 'action', name: 'action', orderable: false, searchable: false},
      {data: 'id', name: 'id', visible: false},
    ],
    order: [[4, 'DESC']], // الترتيب حسب ID
  });

  // --- Create ---
  $('#createNewSupportProgram').on('show.bs.modal', function () {
    $('.text-danger').text('');
    $('#createSupportProgramForm')[0].reset();
  });

  $('#createSupportProgramForm').on('input change', 'input', function () {
    const inputName = $(this).attr('name');
    if (inputName) {
        $('#error_' + inputName).text('');
    }
  });

  $('#createSupportProgramForm').on('submit', function(e) {
    e.preventDefault();
    var currentPage = $('#programs_table').DataTable().page();
    
    $.ajax({
      url: "{{ route('admin.support-programs.store') }}",
      method: 'post',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.status === 'success') {
          $('#createSupportProgramForm')[0].reset();
          $('#programs_table').DataTable().page(currentPage).draw(false);
          $('#createNewSupportProgram').modal('hide');
          toastr.success(data.message);
        } else {
          toastr.error(data.message);
        }
      },
      error: function(data) {
        if (data.responseJSON.errors) {
          $.each(data.responseJSON.errors, function(key, value) {
            $('#error_' + key).text(value[0]);
          });
        }
      }
    });
  });

  // --- Edit ---
  $(document).on("click", ".edit_program", function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');

    $("#edit_id").val(id);
    $("#edit_name").val(name);

    $(".text-danger").text("");
    $("#editSupportProgramModal").modal("show");
  });

  $('#updateSupportProgramForm').on('submit', function(e) {
    e.preventDefault();
    var id = $('#edit_id').val();
    var currentPage = $('#programs_table').DataTable().page();
    
    // استبدال الـ Placeholder بالـ ID الحقيقي
    var url = "{{ route('admin.support-programs.update', ':id') }}";
    url = url.replace(':id', id);

    $.ajax({
      url: url,
      method: 'post',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.status === 'success') {
            $('#programs_table').DataTable().page(currentPage).draw(false);
            $('#editSupportProgramModal').modal('hide');
            toastr.success(data.message);
        } else {
            toastr.error(data.message);
        }
      },
      error: function(data) {
        if (data.responseJSON.errors) {
          $.each(data.responseJSON.errors, function(key, value) {
            $('#edit_error_' + key).text(value[0]);
          });
        }
      }
    });
  });

  // --- Delete ---
  $(document).on('submit', '#deleteSupportProgramForm', function(e) {
    e.preventDefault();
    var form = $(this);
    var modalId = form.closest('.modal').attr('id');
    var id = form.find('input[name="id"]').val();
    var token = form.find('input[name="_token"]').val();
    var currentPage = $('#programs_table').DataTable().page();

    $.ajax({
      url: '/admin/support-programs/' + id,
      type: 'DELETE',
      data: { _token: token },
      success: function(data) {
        if (data.status === 'success') {
          toastr.success(data.message);
          $('#programs_table').DataTable().page(currentPage).draw(false);
          $('#' + modalId).modal('hide');
        } else {
          toastr.error(data.message);
        }
      },
      error: function(xhr) {
        var response = xhr.responseJSON;

        if (response && response.message) {
            toastr.error(response.message); 
        } else {
            toastr.error('حدث خطأ غير متوقع');
        }
        $('#' + modalId).modal('hide');
      }
    });
  });
</script>
@endpush