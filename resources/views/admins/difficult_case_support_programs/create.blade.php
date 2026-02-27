@extends('layouts.master')
@section('title','إضافة دعم الأسر فى وضعية صعبة')
@section('breadcrumpTitle','إضافة دعم الأسر فى وضعية صعبة')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">إضافة دعم الأسر فى وضعية صعبة</li>
@endsection
@section('css')
<style>
  .families-scroll-area {
    max-height: 500px;
    overflow-y: auto;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
  }

  .table-head-fixed th {
    position: sticky;
    top: 0;
    background-color: #343a40;
    color: white;
    z-index: 1;
  }

  .table-success {
    background-color: #d1e7dd !important;
  }

  .cursor-pointer {
    cursor: pointer;
  }

  .invalid-feedback {
    display: block;
    font-size: 0.875em;
    color: #dc3545;
  }

  .is-invalid {
    border-color: #dc3545 !important;
  }
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <form method="post" action="{{ route('admin.difficult_case_support_programs.store') }}" id="assignmentForm" class="modal_style">
          @csrf
          {{-- 1. Basic Info --}}
          <div class="row mb-4 p-3 bg-light border rounded">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label fw-bold">البرنامج <span class="text-danger">*</span></label>
                <select name="support_program_id" id="support_program_id" class="form-control" required>
                  <option selected disabled value="">-- اختر البرنامج --</option>
                  @foreach($programs as $program)
                  <option value="{{ $program->id }}">{{ $program->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label fw-bold">تاريخ الدعم <span class="text-danger">*</span></label>
                <input type="date" name="date" class="form-control" required >
              </div>
            </div>
          </div>
          <hr>
          {{-- 2. Families List --}}
          <div id="families-container" class="row mb-4">
            <div class="col-md-12">
              <div class="d-flex justify-content-between align-items-center mb-2" id="families-header">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="select-all">
                  <label class="form-check-label fw-bold cursor-pointer" for="select-all">تحديد الكل</label>
                </div>
                <span class="badge bg-success text-white p-2" style="font-size: 14px;" id="count-badge">0 أسرة مختارة</span>
              </div>
              <div id="loading-spinner" class="text-center py-5">
                <i class="fa fa-spinner fa-spin fa-3x text-primary"></i>
                <p class="mt-2">جاري تحميل قائمة الأسر...</p>
              </div>
              <div class="families-scroll-area d-none" id="table-area">
                <table class="table table-hover table-bordered mb-0 text-center">
                  <thead class="table-head">
                    <tr>
                      <th width="50">#</th>
                      <th>الاسم الكامل</th>
                      <th>رقم الهوية</th>
                      <th>عدد الأفراد</th>
                      <th>نوع الحالة</th>
                    </tr>
                  </thead>
                  <tbody id="families-table-body"></tbody>
                </table>
              </div>
              <div id="no-data-message" class="alert alert-warning text-center mt-2 d-none">لا توجد أسر مسجلة حالياً للعرض.</div>
            </div>
          </div>
          {{-- 3. Submit Button --}}
          <div class="text-start pt-3">
            <button type="submit" class="button black x-small"><i class="fa fa-save"></i>&nbsp; حفظ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script>
  $(document).ready(function() {
    var isSubmitting = false;
    // Auto-load families on page init
    loadFamilies();

    // Initialize Form Validation
    $('#assignmentForm').validate({
        rules: { support_program_id: "required", date: "required" },
        messages: { support_program_id: "حقل البرنامج مطلوب", date: "حقل التاريخ مطلوب" },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            // 1. Manual validation for checkboxes
            if ($('.family-checkbox:checked').length === 0) {
                $('#families-error').remove();
                $('#families-header').after('<div id="families-error" class="alert alert-danger mt-2 py-2"><i class="fa fa-exclamation-triangle"></i> يرجى اختيار أسرة واحدة على الأقل.</div>');
                $('html, body').animate({ scrollTop: $("#families-header").offset().top - 100 }, 500);
                return false;
            }
            $('#families-error').remove();
            
            // 2. Prevent double submission
            if (isSubmitting) return false;
            isSubmitting = true;
            
            // 3. UI Handling (Disable button & Spinner)
            var submitBtn = $(form).find('button[type="submit"]');
            var originalText = submitBtn.html();
            submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> جاري الحفظ...');

            // 4. Data Preparation: Collect IDs manually and stringify to bypass server input limits
            var selectedIds = [];
            $('.family-checkbox:checked').each(function() { selectedIds.push($(this).val()); });

            var dataPayload = {
                _token: $('input[name="_token"]').val(),
                support_program_id: $('#support_program_id').val(),
                date: $('input[name="date"]').val(),
                family_ids: JSON.stringify(selectedIds) // Send as JSON string
            };
            // 5. AJAX Submission
            $.ajax({
                url: $(form).attr('action'),
                type: "POST",
                data: dataPayload,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(function() { window.location.href = "{{ route('admin.difficult_case_support_programs.create') }}"; }, 1000);
                    } else {
                        toastr.error(response.message);
                        submitBtn.prop('disabled', false).html(originalText);
                        isSubmitting = false;
                    }
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).html(originalText);
                    isSubmitting = false;
                    toastr.error('حدث خطأ أثناء الحفظ');
                    console.error(xhr.responseText);
                }
            });
            return false;
        }
    });
    // Load Families Logic (AJAX)
    function loadFamilies() {
        var tableArea = $('#table-area'), tbody = $('#families-table-body'), spinner = $('#loading-spinner'), noDataMsg = $('#no-data-message');
        tbody.empty(); 
        $('#select-all').prop('checked', false);
        $.ajax({
            url: "{{ route('admin.difficult_case_support_programs.get_eligible_families') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                spinner.addClass('d-none');
                if(Array.isArray(response) && response.length > 0) {
                    tableArea.removeClass('d-none');
                    var rows = '';
                    $.each(response, function(index, family) {
                        rows += `<tr class="cursor-pointer family-row">
                                    <td class="text-center"><input type="checkbox" name="family_ids[]" value="${family.id}" class="family-checkbox form-check-input"></td>
                                    <td>${family.full_name}</td><td>${family.national_id}</td>
                                    <td><span class="badge bg-success">${family.members_count}</span></td>
                                    <td>${family.type_text}</td>
                                </tr>`;
                    });
                    tbody.html(rows);
                } else { noDataMsg.removeClass('d-none'); }
            },
            error: function(xhr) { spinner.addClass('d-none'); toastr.error("حدث خطأ أثناء تحميل البيانات"); }
        });
    }

    // Checkbox Logic & Interactions
    $('#select-all').on('change', function() {
      var isChecked = $(this).prop('checked');
      $('.family-checkbox').each(function() { $(this).prop('checked', isChecked); toggleRowColor($(this)); });
      updateCount();
      if(isChecked) $('#families-error').remove();
    });
    $(document).on('change', '.family-checkbox', function() {
        if(!this.checked) $('#select-all').prop('checked', false);
        toggleRowColor($(this)); updateCount();
        if(this.checked) $('#families-error').remove();
    });
    $(document).on('click', '.family-row', function(e) {
        if (e.target.type !== 'checkbox') {
            var checkbox = $(this).find('.family-checkbox');
            checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
        }
    });
    function toggleRowColor(checkbox) {
        if(checkbox.is(':checked')) checkbox.closest('tr').addClass('table-success');
        else checkbox.closest('tr').removeClass('table-success');
    }
    function updateCount() { $('#count-badge').text($('.family-checkbox:checked').length + ' أسرة مختارة'); }
  });
</script>
@endpush