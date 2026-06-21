@extends('layouts.master')

@section('title', 'الأيتام غير المكفولين')
@section('breadcrumpTitle', 'الأيتام غير المكفولين')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">الأيتام غير المكفولين</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="unsponsored_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
                        <thead class="table-head">
                            <tr>
                                <th>#</th>
                                <th>اسم اليتيم</th>
                                <th>الجنس</th>
                                <th>تاريخ الازدياد</th>
                                <th>الإقليم</th>
                                <th>المدينة / الجماعة</th>
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
$('#unsponsored_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("sponsor.unsponsored-orphans.data") }}',
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        {data: 'name_ar', name: 'name_ar'},
        {data: 'gender', name: 'gender'},
        {data: 'birth_date', name: 'birth_date'},
        {data: 'governorate', name: 'governorate.name', orderable: false},
        {data: 'city', name: 'city.name', orderable: false},
        {data: 'id', name: 'id', visible: false},
    ],
    order: [[6, 'desc']],
});
</script>
@endpush