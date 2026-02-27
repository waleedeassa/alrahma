@extends('layouts.master')

@section('title', 'النسخ الاحتياطية')
@section('breadcrumpTitle', 'النسخ الاحتياطية')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">النسخ الاحتياطية</li>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <a href="{{ route('admin.backups.create') }}" class="button black x-small" style="margin-left: 10px;">
          <i class="fa fa-cloud-upload"></i>
          إضافة نسخة احتياطية
        </a>
        <button type="button" class="button black x-small" data-bs-toggle="modal" data-bs-target="#bulkDeleteModal" style="margin-left: 10px;">
          <i class="fa fa-trash-o"></i>
          حذف النسخ المحددة
        </button>
        <br><br>
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0" data-page-length="10" style="text-align: center">
            <thead class="table-head">
              <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>#</th>
                <th>اسم الملف</th>
                <th>تاريخ الإنشاء</th>
                <th>وقت الإنشاء</th>
                <th>حجم الملف</th>
                <th>العمليات</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($backups as $backup)
              <tr>
                <td>
                  <input type="checkbox" name="backups[]" value="{{ $backup->getFilename() }}">
                </td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $backup->getFilename() }}</td>
                <td>{{ date('Y-m-d', $backup->getCTime()) }}</td>
                <td>{{ date('H:i:s', $backup->getCTime()) }}</td>
                <td>{{ round($backup->getSize() / 1024, 2) }} KB</td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{ route('admin.backups.download', $backup->getFilename()) }}">
                    <i class="fa fa-cloud-download"></i>
                    تحميل
                  </a>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_backup{{ $backup->getCTime() }}" title="حذف">
                    <i class="fa fa-trash"></i>
                    حذف
                  </button>
                </td>
              </tr>
              {{-- delete modal --}}
              <div class="modal fade" id="delete_backup{{ $backup->getCTime() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <form action="{{ route('admin.backups.destroy', $backup->getFilename()) }}" method="post">
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">حذف النسخة الاحتياطية</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        <p>هل أنت متأكد من حذف هذه النسخة الاحتياطية؟</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                          إغلاق
                        </button>
                        <button type="submit" class="btn btn-success">
                          موافق
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

{{-- delete bulk modal --}}
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="bulk-delete-modal-form" action="{{ route('admin.backups.bulkDestroy') }}" method="POST">
      @csrf

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">حذف النسخ الاحتياطية المحددة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>هل أنت متأكد من حذف النسخ الاحتياطية المحددة؟</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            إغلاق
          </button>
          <button type="submit" class="btn btn-success" id="confirm-bulk-delete">
            موافق
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('js')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // select all checkbox 
    var selectAll = document.getElementById('select-all');
    if (selectAll) {
        selectAll.addEventListener('click', function (event) {
            var checkboxes = document.querySelectorAll('input[name="backups[]"]');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = event.target.checked;
            });
        });
    }
    // confirm bulk delete
    var confirmBulkDelete = document.getElementById('confirm-bulk-delete');
    if (confirmBulkDelete) {
        confirmBulkDelete.addEventListener('click', function (event) {
            event.preventDefault();
            var checkboxes = document.querySelectorAll('input[name="backups[]"]:checked');
            if (checkboxes.length > 0) {
                var form = document.getElementById('bulk-delete-modal-form');
                // remove existing hidden inputs
                form.querySelectorAll('input[type="hidden"][name="backups[]"]').forEach(function (el) {
                    el.remove();
                });
                checkboxes.forEach(function (checkbox) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'backups[]';
                    input.value = checkbox.value;
                    form.appendChild(input);
                });
                form.submit();
            } else {
                toastr.error('الرجاء تحديد نسخة احتياطية واحدة على الأقل للحذف');
            }
        });
    }

});
</script>
@endpush