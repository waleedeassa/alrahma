@extends('layouts.master')
@section('title', 'سجلات الاستفادة من برامج الدعم')
@section('breadcrumpTitle', 'سجلات الاستفادة من برامج الدعم')
@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">سجلات الاستفادة من برامج الدعم</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <br>
                    @can('إضافة سجل استفادة من برامج الدعم')
                    <a href="{{ route('admin.support-program-entries.create') }}" class="button black x-small text-end mb-3" style="direction: rtl; display: inline-block;">
                        <i class="fa fa-plus"></i>&nbsp; إضافة سجل استفادة
                    </a>
                    @endcan
                    <form class="modal_style mb-3" id="filters-form">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="mb-2">البرنامج</label>
                                <select id="filter_program" class="form-control">
                                    <option value="">الكل</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="mb-2">الفئة المستفيدة</label>
                                <select id="filter_category" class="form-control">
                                    <option value="">الكل</option>
                                    @foreach ($categories as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="mb-2">الجهة الممولة</label>
                                <input type="text" id="filter_funding_source" class="form-control" placeholder="ابحث بالجهة الممولة">
                            </div>
                            <div class="col-md-3">
                                <label class="mt-2 mb-2">من تاريخ</label>
                                <input type="date" id="filter_date_from" class="form-control">
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="mb-2">إلى تاريخ</label>
                                <input type="date" id="filter_date_to" class="form-control">
                            </div>

                            {{-- reset filters --}}
                            <div class="col-md-12 mt-4">
                                <button type="button" id="reset-filters" class="button black x-small">
                                    <i class="fa fa-undo"></i>&nbsp; إعادة تعيين الفلاتر
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table id="yajra_table" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
                            <thead class="table-head">
                                <tr>
                                    <th>#</th>
                                    <th>البرنامج</th>
                                    <th>الفئة المستفيدة</th>
                                    <th>عدد المستفيدين</th>
                                    <th>الجهة الممولة</th>
                                    <th>التاريخ</th>
                                    <th>المرفقات</th>
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
                url: '{{ route('admin.get-support-program-entries') }}',
                data: function(d) {
                    d.support_program_id = $('#filter_program').val();
                    d.beneficiary_category = $('#filter_category').val();
                    d.funding_source = $('#filter_funding_source').val();
                    d.date_from = $('#filter_date_from').val();
                    d.date_to = $('#filter_date_to').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'program_name',
                    name: 'program.name'
                },
                {
                    data: 'category_label',
                    name: 'beneficiary_category'
                },
                {
                    data: 'beneficiaries_count',
                    name: 'beneficiaries_count'
                },
                {
                    data: 'funding_source',
                    name: 'funding_source'
                },
                {
                    data: 'date_formatted',
                    name: 'date'
                },
                {
                    data: 'attachments_count',
                    name: 'attachments_count',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    orderable: true
                    
                },
            ],
            order: [
                [8, 'desc']
            ],
        });

        $('#filter_program').on('change', () => table.draw());
        $('#filter_category').on('change', () => table.draw());
        $('#filter_date_from').on('change', () => table.draw());
        $('#filter_date_to').on('change', () => table.draw());

        let fundingSourceTimer;
        $('#filter_funding_source').on('keyup', function() {
            clearTimeout(fundingSourceTimer);
            fundingSourceTimer = setTimeout(() => table.draw(), 400);
        });

        $('#reset-filters').on('click', function() {
            $('#filters-form')[0].reset();
            table.draw();
        });
    </script>

    {{-- Delete entry --}}
    <script>
        $(document).on('submit', 'form[id^="deleteSupportProgramEntryForm_"]', function(e) {
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
                    toastr.error(xhr.responseJSON?.message || 'حدث خطأ ما');
                }
            });
        });
    </script>
@endpush
