@extends('layouts.master')
@section('title', "الأيتام المكفولين")
@section('breadcrumpTitle', "الأيتام المكفولين")

@section('breadcrump')
@parent
<li class="breadcrumb-item active">الأيتام المكفولين</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <div class="table-responsive">
          <table id="yajra_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th>#</th>
                <th>اسم اليتيم</th>
                <th>الجنس</th>
                <th>تاريخ الازدياد</th>
                <th>الإقليم</th>
                <th>المدينة / الجماعة</th>
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
<script>
$('#yajra_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("sponsor.get-sponsored-orphans") }}',
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        {data: 'name_ar', name: 'name_ar'},
        {data: 'gender', name: 'gender'},
        {data: 'birth_date', name: 'birth_date'},
        {data: 'governorate', name: 'governorate.name', orderable: false},
        {data: 'city', name: 'city.name', orderable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false},
        {data: 'id', name: 'id', visible: false},
    ],
    order: [[6, 'desc']],
});
</script>
@endpush
