@extends('layouts.master')
@section('title', "الصلاحيات")
@section('breadcrumpTitle', "الصلاحيات")

@section('breadcrump')
@parent
<li class="breadcrumb-item active">الصلاحيات</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                {{-- @can('اضافة صلاحية') --}}
                <button type="button" class="button black" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
                    <i class="fa fa-plus"></i>&nbsp; اضافة صلاحية
                </button>
                {{-- @endcan --}}
                <br><br>
                <div class="table-responsive">
                    <table id="permissions_datatable" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
                        <thead class="table-head">
                            <tr>
                                <th>#</th>
                                <th>اسم الصلاحية</th>
                                <th>اسم المجموعة</th>
                                <th>تاريخ الإضافة</th>
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

@include('admins.permissions._create')
@include('admins.permissions._edit')

@endsection

@push('js')
<script>
$(document).ready(function() {
    var table = $('#permissions_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.get-permissions") }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            {data: 'name', name: 'name'},
            {data: 'group_name', name: 'group_name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[3, 'desc']]
    });

    // Create Permission
    $('#createPermissionForm').on('submit', function(e) {
        e.preventDefault();
        $('.text-danger').text('');
        $.ajax({
            url: "{{ route('admin.permissions.store') }}",
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status === 'success') {
                    $('#createPermissionModal').modal('hide');
                    $('#createPermissionForm')[0].reset();
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

    // Edit Permission (Show data in modal)
    $(document).on('click', '.edit_permission', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var group_name = $(this).data('group_name');

        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_group_name').val(group_name); // Set the select value

        $('.text-danger').text('');
        $('#editPermissionModal').modal('show');
    });

    // Update Permission
    $('#updatePermissionForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#edit_id').val();
        $.ajax({
            url: "/admin/permissions/" + id, 
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status === 'success') {
                    $('#editPermissionModal').modal('hide');
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

    // Delete Permission
    $(document).on('submit', '.deletePermissionForm', function(e) {
        e.preventDefault();
        var form = $(this);
        var modal = form.closest('.modal');
        var url = form.attr('action');
        var currentPage = $('#permissions_datatable').DataTable().page();

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function(data) {
                if (data.status === 'success') {
                    toastr.success(data.message);
                    table.page(currentPage).draw(false);
                    modal.modal('hide');
                    modal.on('hidden.bs.modal', function() {
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