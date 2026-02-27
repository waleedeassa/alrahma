@extends('layouts.master')
@section('title', 'الأيتام')
@section('breadcrumpTitle', 'الأيتام')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">الأيتام</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        {{-- <a href="{{ route('admin.orphans.export') }}" class="button black x-small">
          <i class="fa fa-file-excel-o"></i>&nbsp; تصدير إلى اكسيل
        </a> --}}
        {{-- <br><br> --}}
        <br>
        <form class="modal_style mb-3" id="filters-form">
          <div class="row">
            <div class="col-md-3">
              <label class="mb-2">حالة الكفالة</label>
              <select id="filter_sponsorship" class="form-control">
                <option value="">الكل</option>
                <option value="1">مكفول</option>
                <option value="0">غير مكفول</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="mb-2">المستوى الدراسي</label>
              <select id="filter_academic_level" class="form-control">
                <option value="">الكل</option>
                @foreach(config('options.academic_level') as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label class="mb-2">اسم الكفيل</label>
              <select id="filter_sponsor" class="form-control">
                <option value="">الكل</option>
                @foreach($sponsors as $sponsor)
                <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label class="mb-2">الإقليم</label>
              <select id="filter_governorate" class="form-control">
                <option value="">الكل</option>
                @foreach($governorates as $gov)
                <option value="{{ $gov->id }}">{{ $gov->name }}</option>
                @endforeach
              </select>
            </div>
            {{--reset filters--}}
            <div class="col-md-12 mt-4 ">
              <button type="button" id="reset-filters" class="button black x-small"><i class="fa fa-undo"></i>&nbsp;
                إعادة تعيين الفلاتر
              </button>
              <a href="{{ route('admin.orphans.export') }}" class="button black x-small" id="btn-export-excel">
                <i class="fa fa-file-excel-o"></i>&nbsp; تصدير إلى اكسيل
              </a>
            </div>
          </div>
        </form>
        <br>
        <div class="table-responsive">
          <table id="yajra_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th>الصورة</th>
                <th>رقم ملف الأسرة</th>
                <th>رمز اليتيم</th>
                <th>الاسم العائلي</th>
                <th>الاسم الشخصي</th>
                <th>السن</th>
                <th>المستوى الدراسي</th>
                <th>حالة الكفالة</th>
                <th>اسم الكفيل</th>
                <th>الاقليم</th>
                <th>المدينة / الجماعة</th>
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
@endsection

@push('js')
<script>
  let table = $('#yajra_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: '{{ route("admin.get-orphans") }}',
    data: function (d) {
      d.sponsorship_status = $('#filter_sponsorship').val();
      d.academic_level     = $('#filter_academic_level').val();
      d.sponsor_id         = $('#filter_sponsor').val();
      d.governorate_id     = $('#filter_governorate').val();
    }
  },
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
      {data: 'image', name: 'image', orderable: false, searchable: false},
      {data: 'family_file_no', name: 'family_id'}, 
      {data: 'orphan_sponsorship_code', name: 'orphan_sponsorship_code'},
      {data: 'family_name_ar', name: 'family_name_ar'},
      {data: 'name_ar', name: 'name_ar'},
      {data: 'age', name: 'age', searchable: false, orderable: false}, 
      {data: 'academic_level', name: 'academic_level'},
      {data: 'sponsorship_status', name: 'sponsorship_status', searchable: false},
      {data: 'sponsor_name', name: 'sponsor.name', searchable: false, orderable: false},
      {data: 'governorate_name', name: 'governorate.name'}, 
      {data: 'city_name', name: 'city.name'},
      
      {data: 'action', name: 'action', orderable: false, searchable: false},
      {data: 'id', name: 'id',visible: false},
    ],
    order: [[2, 'desc']], 
  });

$('#filter_sponsorship').on('change', () => table.draw());
$('#filter_academic_level').on('change', () => table.draw());
$('#filter_governorate').on('change', () => table.draw());
$('#filter_sponsor').on('change', () => table.draw());

$('#reset-filters').on('click', function () {
  $('#filters-form')[0].reset();
  table.draw();
});

$('#btn-export-excel').on('click', function(e) {
    e.preventDefault();
    // 1. جلب القيم الحالية من الفلاتر
    let params = {
        sponsorship_status: $('#filter_sponsorship').val(),
        academic_level:     $('#filter_academic_level').val(),
        sponsor_id:         $('#filter_sponsor').val(),
        governorate_id:     $('#filter_governorate').val(),
    };

    // 2. تحويلها إلى Query String
    let queryString = $.param(params);

    // 3. التوجيه للرابط مع البيانات
    // سيصبح الرابط مثلاً: /orphans-export?sponsorship_status=1&governorate_id=5
    window.location.href = "{{ route('admin.orphans.export') }}?" + queryString;
});

</script>
<script>
  $(document).on('submit', '.change-status-form', function(e) {

    e.preventDefault();

    let form = $(this);
    let url = form.data('url');
    let orphanId = form.data('id');
    let modal = $('#changeStatus_orphan' + orphanId);
    let errorElement = form.find('.error-message');

    errorElement.addClass('d-none');

    $.ajax({
        url: url,
        type: "POST",
        data: form.serialize(),
        success: function(response) {

            modal.modal('hide');

            $('#yajra_table').DataTable().ajax.reload(null, false);

            toastr.success(response.message);

        },
        error: function(xhr) {

            if (xhr.status === 422) {
                 let errors = xhr.responseJSON.errors;

                if (errors.cancellation_reason) {
                    errorElement
                        .text(errors.cancellation_reason[0])
                        .removeClass('d-none');
                }
            } else {
                toastr.error('حدث خطأ غير متوقع');
            }
        }
    });

});
</script>
@endpush