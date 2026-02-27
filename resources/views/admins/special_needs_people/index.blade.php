@extends('layouts.master')
@section('title', 'المرضى وذوي الإحتياجات الخاصة')
@section('breadcrumpTitle', 'المرضى وذوي الإحتياجات الخاصة')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">المرضى وذوي الإحتياجات الخاصة</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">

        <a href="{{ route('admin.special-needs-people.create') }}" type="button" class="button black">
          <i class="fa fa-plus"></i>&nbsp; إضافة حالة
        </a>
        <a href="{{ route('admin.special-needs-people.export') }}" class="button black x-small">
          <i class="fa fa-file-excel-o"></i>&nbsp; تصدير إلى إكسيل
        </a>
        <br><br>
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
                <th>نوع الاحتياج</th>
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

                <!-- support history modal -->
        <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;">
                  سجل الدعم : <span class="text-primary" id="modal_family_name"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered text-center">
                    <thead class="table-head">
                      <tr>
                        <th>#</th>
                        <th>اسم البرنامج</th>
                        <th>تاريخ الحصول عليه</th>
                        <th>حذف</th>
                      </tr>
                    </thead>
                    <tbody id="history_table_body">

                    </tbody>
                  </table>
                </div>
                {{--loading spinner --}}
                <div id="history_loading" class="text-center py-3">
                  <i class="fa fa-spinner fa-spin fa-2x"></i>
                </div>
                <div id="history_empty" class="alert alert-danger text-center d-none">
                  لا يوجد سجل مساعدات لهذه الأسرة.
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">إغلاق</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Confirm Delete Support Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1060;"> 
          {{-- <div class="modal-dialog" role="document"> --}}
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"></span>
                </button>
              </div>
              <div class="modal-body">
                <p style="text-align: right;"> هل أنت متأكد من حذف هذا السجل؟</p>
                <input type="hidden" id="delete_target_url">
                <input type="hidden" id="delete_target_id">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn btn-success" id="confirm_delete_btn">موافق</button>
              </div>
            </div>
          </div>
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
    ajax:'{{ route("admin.get-special-needs-people") }}',
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
      {data: 'id', name: 'id'},
      {data: 'last_name_ar', name: 'last_name_ar'},
      {data: 'first_name_ar', name: 'first_name_ar'},
      {data: 'national_id_no', name: 'national_id_no'},
      {data: 'birth_date', name: 'birth_date'},
      {data: 'family_members_count', name: 'family_members_count'},
      {
        data: 'special_needs_type_label',
        name: 'special_needs_type_label',
        searchable: false,
        orderable: false
      },
      {
        data: 'social_status_label',
        name: 'social_status_label',
        searchable: false,
        orderable: false
      },
      {data: 'governorate_name', name: 'governorate.name'},
      {data: 'city_name', name: 'city.name'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    order: [[1, 'DESC']],
  });

      $(document).on('click', '.delete-task-btn', function(e) {
      e.preventDefault();
    });
    // Difficult Case Support Program History
    $(document).ready(function() {
        $(document).on('click', '.show-history-btn', function() {
            var familyId = $(this).data('id');
            var familyName = $(this).data('name');
            
            // 1. prepare modal
            $('#modal_family_name').text(familyName);
            $('#history_table_body').empty();
            $('#history_loading').removeClass('d-none');
            $('#history_empty').addClass('d-none');
            $('#historyModal').modal('show');

            // 2. get history data
            var url = "{{ route('admin.special_needs_people_support_programs.history', ':id') }}";
            url = url.replace(':id', familyId);
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    $('#history_loading').addClass('d-none');
                    if (response.length > 0) {
                        var rows = '';
                        $.each(response, function(index, item) {
                            // 3. prepare delete url
                            var deleteUrl = "{{ route('admin.special_needs_people_support_programs.destroy', ':id') }}";
                            deleteUrl = deleteUrl.replace(':id', item.pivot_id);
                            rows += `
                                <tr id="row_${item.pivot_id}">
                                    <td>${index + 1}</td>
                                    <td>${item.program_name}</td>
                                    <td>${item.date}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete-support-btn" 
                                            data-url="${deleteUrl}" 
                                            data-id="${item.pivot_id}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#history_table_body').html(rows);
                    } else {
                        $('#history_empty').removeClass('d-none');
                    }
                },
                error: function() {
                    $('#history_loading').addClass('d-none');
                    toastr.error('حدث خطأ أثناء جلب البيانات');
                }
            });
        });

        // 1. when click on delete button in modal
        $(document).on('click', '.delete-support-btn', function() {
            var btn = $(this);
            var url = btn.data('url');
            var id = btn.data('id');
 console.log('Delete button clicked:', { url: url, id: id }); // Debug
              // 2. store url and id in hidden inputs
            $('#delete_target_url').val(url);
            $('#delete_target_id').val(id);

            // 3. show modal
            $('#confirmDeleteModal').modal('show');
        });
        // 4. when click on confirm delete button
        $('#confirm_delete_btn').click(function() {
            var btn = $(this);
            var url = $('#delete_target_url').val();
            var id = $('#delete_target_id').val();
            // disable button to prevent multiple clicks
            btn.prop('disabled', true).text('جاري الحذف...');
                    $.ajax({
                        url: url,
                        type: "POST", 
                        data: {
                            _method: 'DELETE',
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#confirmDeleteModal').modal('hide');
                            btn.prop('disabled', false).text('موافق');
                            toastr.success(response.message || 'تم الحذف بنجاح');
                            // remove deleted row from table with reload page
                            $('#row_' + id).fadeOut(300, function() { $(this).remove(); });
                        },
                        error: function(xhr) {
                            $('#confirmDeleteModal').modal('hide');
                            btn.prop('disabled', false).text('موافق');
                            toastr.error('حدث خطأ أثناء الحذف');
                        }
                    });
                });
    });

</script>
@endpush