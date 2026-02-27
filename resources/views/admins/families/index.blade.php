@extends('layouts.master')
@section('title', 'الأسر')
@section('breadcrumpTitle', 'الأسر')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">الأسر</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <a  href="{{ route('admin.families.create') }}" type="button" class="button black" ><i class="fa fa-plus"></i>&nbsp; اضافة أسرة</a>
        <a href="{{ route('admin.families.export') }}" class="button black x-small"><i class="fa fa-file-excel-o"></i>&nbsp; تصدير إلى اكسيل </a>
        <br>
        <br>
        <div class="table-responsive">
          <table id="yajra_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th> رقم ملف الأسرة</th>
                <th>الاسم العائلي </th>
                <th>الاسم الشخصى </th>
                <th>البطاقة الوطنية</th>
                <th>تاريخ الازدياد</th>
                <th>عدد افراد الاسرة</th>
                <th>الاقليم</th>
                <th>المدينة / الجماعة</th>
                <th>الحساب البنكي</th>
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
@endsection

@push('js')
<!-- DataTables JS -->
<script>
  $('#yajra_table').DataTable({
    processing: true,
    serverSide: true,
    ajax:'{{ route("admin.get-families") }}',
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
      {data: 'id', name: 'id',visible: true},
      {data: 'mother_family_name', name: 'mother_family_name'},
      {data: 'mother_name', name: 'mother_name'},
      {data: 'mother_id_no', name: 'mother_id_no'},
      {data: 'mother_birth_date', name: 'mother_birth_date'},
      {data: 'number_of_family_members', name: 'number_of_family_members'},
      {data: 'governorate_name', name: 'governorate.name'},
      {data: 'city_name', name: 'city.name'},
      {data: 'bank_account_number', name: 'bank_account_number'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    order: [[1, 'DESC']],
});

    // Prevent default action of delete button
    $(document).on('click', '.delete-task-btn', function(e) {
  e.preventDefault();
    });


</script>
@endpush