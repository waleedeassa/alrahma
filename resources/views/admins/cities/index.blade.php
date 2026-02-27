@extends('layouts.master')
@section('title', 'المدن - الجماعات')
@section('breadcrumpTitle', 'المدن - الجماعات')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">المدن - الجماعات</li>
@endsection
@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <button type="button" class="button black" data-bs-target="#createNewCity" data-bs-toggle="modal"><i class="fa fa-plus"></i>&nbsp;  اضافة مدينة - جماعة</button>
        <br>
        <br>
        <div class="table-responsive" id="print2">
          <table id="yajra_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>الاقليم</th>
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
@include('admins.cities._create')
@include('admins.cities._edit')
@endsection
@push('js')
<script>
  // Initialize DataTable
    $('#yajra_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.get-cities") }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            {data: 'name', name: 'name'},
            {data: 'governorate_name', name: 'governorate.name'}, // لاحظ كيفية الوصول لاسم الاقليم
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'id', name: 'id', visible: false},
        ],
        order: [[5, 'DESC']],
    });

    // Create City Modal
    $('#createNewCity').on('show.bs.modal', function () {
        $('.text-danger').text('');
        $('#createCity')[0].reset();
    });

    $('#createCity').on('submit', function(e) {
        e.preventDefault();
        var currentPage = $('#yajra_table').DataTable().page();
        $.ajax({
            url: "{{ route('admin.cities.store') }}",
            method: 'post',
            data: new FormData(this),
            processData: false, contentType: false,
            success: function(data) {
                if (data.status === 'success') {
                    $('#yajra_table').DataTable().page(currentPage).draw(false);
                    $('#createNewCity').modal('hide');
                    toastr.success(data.message);
                }
            },
            error: function(data) {
                $('.text-danger').text('');
                $.each(data.responseJSON.errors, function(key, value) {
                    $('#error_' + key).text(value[0]);
                });
            }
        });
    });

    // Edit City
    $(document).on("click", ".edit_city", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        var governorateId = $(this).data('governorate-id');

        $("#edit_id").val(id);
        $("#edit_name").val(name);
        $("#edit_governorate_id").val(governorateId);

        $(".text-danger").text("");
        $("#editCityModal").modal("show");
    });

    // Update City
    $('#updateCity').on('submit', function(e) {
        e.preventDefault();
        var id = $('#edit_id').val();
        var currentPage = $('#yajra_table').DataTable().page();
        $.ajax({
            url: "{{ route('admin.cities.update', 'id') }}".replace('id', id),
            method: 'post',
            data: new FormData(this),
            processData: false, contentType: false,
            success: function(data) {
                if (data.status === 'success') {
                    $('#yajra_table').DataTable().page(currentPage).draw(false);
                    $('#editCityModal').modal('hide');
                    toastr.success(data.message);
                }
            },
            error: function(data) {
                $('.text-danger').text('');
                $.each(data.responseJSON.errors, function(key, value) {
                    $('#edit_error_' + key).text(value[0]);
                });
            }
        });
    });

    // Delete City
    $(document).on('submit', 'form[id^="deleteCityForm_"]', function(e) {
        e.preventDefault();
        var form = $(this);
        var modal = form.closest('.modal');
        var currentPage = $('#yajra_table').DataTable().page();
        $.ajax({
            url: form.attr('action'),
            type: 'DELETE',
            data: form.serialize(),
            success: function(data) {
                if (data.status === 'success') {
                    $('#yajra_table').DataTable().page(currentPage).draw(false);
                    modal.modal('hide');
                    toastr.success(data.message);
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Unexpected error occurred');
            }
        });
    });
</script>
@endpush