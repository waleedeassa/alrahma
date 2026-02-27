@extends('layouts.master')
@section('title', 'الكفلاء')
@section('breadcrumpTitle', 'الكفلاء')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">الكفلاء</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button" class="button black" data-bs-target="#createSponsorModal" data-bs-toggle="modal"><i class="fa fa-plus"></i>&nbsp; إضافة كفيل</button>
                <a href="{{ route('admin.sponsors.export') }}" class="button black x-small"><i class="fa fa-file-excel-o"></i>&nbsp; تصدير إلى اكسيل </a>
                <br><br>
                <div class="table-responsive" id="print2">
                    <table id="sponsors_datatable" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
                        <thead class="table-head">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>النوع</th>
                                <th>البريد الإلكتروني</th>
                                <th>الهاتف</th>
                                <th>الحالة</th>
                                <th>عنوان الاقامة</th>
                                <th>عدد الأيتام المكفولين</th>
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
@include('admins.sponsors._create')
@include('admins.sponsors._edit')
@endsection

@push('js')
<script>
// Initialize DataTable
$('#sponsors_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("admin.get-sponsors") }}',
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        {data: 'name', name: 'name'},
        {data: 'type', name: 'type'},
        {data: 'email', name: 'email'},
        {data: 'phone', name: 'phone'},
        {data: 'status', name: 'status'},
        {data: 'address', name: 'address'},
        {data: 'orphans_count', name: 'orphans_count'},
        {data: 'created_at', name: 'created_at', render: function(data) { return new Date(data).toISOString().split('T')[0]; }},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    order: [[7, 'desc']]
});

// Create Sponsor Modal
$('#createSponsorModal').on('show.bs.modal', function () {
    $('.text-danger').text('');
    $('#createSponsorForm')[0].reset();
});

$('#createSponsorForm').on('input change', 'input, select', function () {
    const inputName = $(this).attr('name');
    if (inputName) {
        const sanitizedKey = inputName.replace(/\./g, '_');
        $('#error_' + sanitizedKey).text('');
    }
});

$('#createSponsorForm').on('submit', function(e) {
    e.preventDefault();
    var currentPage = $('#sponsors_datatable').DataTable().page();
    
    $.ajax({
        url: "{{ route('admin.sponsors.store') }}",
        method: 'post',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.status === 'success') {
                $('#createSponsorForm')[0].reset();
                $('.text-danger').text('');
                $('#sponsors_datatable').DataTable().page(currentPage).draw(false);
                $('#createSponsorModal').modal('hide');
                toastr.success(data.message);
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

// Edit Sponsor
$(document).on("click", ".edit_sponsor", function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $("#edit_id").val(id);
    $("#edit_name").val($(this).data('name'));
    $("#edit_type").val($(this).data('type'));
    $("#edit_email").val($(this).data('email'));
    $("#edit_phone").val($(this).data('phone'));
    $("#edit_status").val($(this).data('status'));
    $("#edit_address").val($(this).data('address'));

    $(".text-danger").text("");
    $("#editSponsorModal").modal("show");
});

// Update Sponsor
$('#updateSponsorForm').on('submit', function(e) {
    e.preventDefault();
    var id = $('#edit_id').val();
    var currentPage = $('#sponsors_datatable').DataTable().page();
    
    $.ajax({
        url: "/admin/sponsors/" + id,
        method: 'post',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.status === 'success') {
                $('#updateSponsorForm')[0].reset();
                $('.text-danger').text('');
                $('#sponsors_datatable').DataTable().page(currentPage).draw(false);
                $('#editSponsorModal').modal('hide');
                toastr.success(data.message);
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

$('#editSponsorModal').on('show.bs.modal', function() {
    $('.text-danger').text('');
});

// Delete Sponsor
$(document).on('submit', '.deleteSponsorForm', function(e) {
    e.preventDefault();
    var form = $(this);
    var modalId = form.closest('.modal').attr('id');
    var sponsorId = form.find('input[name="id"]').val();
    var token = form.find('input[name="_token"]').val();
    var currentPage = $('#sponsors_datatable').DataTable().page();

    $.ajax({
        url: '/admin/sponsors/' + sponsorId,
        type: 'DELETE',
        data: {
            _token: token
        },
        success: function(data) {
            if (data.status === 'success') {
                toastr.success(data.message);
                $('#sponsors_datatable').DataTable().page(currentPage).draw(false);
                $('#' + modalId).modal('hide');
                $('#' + modalId).on('hidden.bs.modal', function() {
                    $(this).remove();
                });
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON?.message || 'Unexpected error occurred');
        }
    });
});
</script>

{{-- Change Sponsor Status --}}
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).on('change', '.statusCheckbox', function () {
    // const span = this.nextElementSibling; 
    // if (this.checked) {
    //     span.style.float = 'left'; 
    // } else {
    //     span.style.float = 'right'; 
    // }
    var currentPage = $('#sponsors_datatable').DataTable().page();
    var id = $(this).data('id');
    var status = $(this).is(':checked') ? 1 : 0;
    var url = "{{ route('admin.sponsors.status.change', ['id' => ':id']) }}";
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        type: 'POST',
        data: { status: status },
        success: function (response) {
            if (response.status === 'success') {
                toastr.success(response.message);
                $('#sponsors_datatable').DataTable().page(currentPage).draw(false);
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