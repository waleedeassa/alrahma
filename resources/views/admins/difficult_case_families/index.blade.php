@extends('layouts.master')
@section('title', 'الأسر فى وضعية صعبة')
@section('breadcrumpTitle', 'الأسر فى وضعية صعبة')
@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">الأسر فى وضعية صعبة</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @can('اضافة أسرة فى وضعية صعبة')
                        <a href="{{ route('admin.difficult-case-families.create') }}" type="button" class="button black"><i class="fa fa-plus"></i>&nbsp; اضافة حالة صعبة</a>
                        <a href="{{ route('admin.difficult-case-families.export') }}" class="button black x-small"><i class="fa fa-file-excel-o"></i>&nbsp; تصدير إلى اكسيل </a>
                    @endcan
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table id="yajra_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
                            <thead class="table-head">
                                <tr>
                                    <th>#</th>
                                    <th>رقم الحالة</th>
                                    <th>الاسم العائلي</th>
                                    <th>الاسم الشخصي</th>
                                    <th>البطاقة الوطنية</th>
                                    <th>تاريخ الازدياد</th>
                                    <th>عدد أفراد الأسرة</th>
                                    <th>فئة الحالة</th>
                                    <th>الوضعية الاجتماعية</th>
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
@endsection
@push('js')
    <script>
        $('#yajra_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.get-difficult-case-families') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'last_name_ar',
                    name: 'last_name_ar'
                },
                {
                    data: 'first_name_ar',
                    name: 'first_name_ar'
                },
                {
                    data: 'national_id_no',
                    name: 'national_id_no'
                },
                {
                    data: 'birth_date',
                    name: 'birth_date'
                },
                {
                    data: 'family_members_count',
                    name: 'family_members_count'
                },
                {
                    data: 'difficult_case_type_label',
                    name: 'difficult_case_type_label',
                    searchable: false,
                    orderable: false
                }, 
                {
                    data: 'social_status_label',
                    name: 'social_status_label',
                    searchable: false,
                    orderable: false
                }, 
                {
                    data: 'governorate_name',
                    name: 'governorate.name'
                },
                {
                    data: 'city_name',
                    name: 'city.name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [
                [1, 'DESC']
            ],
        });
    </script>
@endpush
