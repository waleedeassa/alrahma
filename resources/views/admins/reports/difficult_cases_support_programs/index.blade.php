@extends('layouts.master')
@section('title','تقرير دعم الأسر فى وضعية صعبة')
@section('breadcrumpTitle','تقرير دعم الأسر فى وضعية صعبة')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">تقرير دعم الأسر فى وضعية صعبة</li>
@endsection
@push('css')
<style>
  .search_select_box div button .filter-option-inner-inner {
    text-align: right;
  }

  table {
    text-align: center;
  }

  table>thead,
  table>tfoot {
    background-color: #dcdcdc;
  }

  table thead,
  tbody,
  tfoot,
  tr,
  td,
  th {
    border-width: 1px;
  }

  button i {
    margin-left: 4px
  }

  table>thead,
  table>tfoot {
    background-color: #dcdcdc;
  }
</style>
@endpush
@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <form id="searchForm" role="search" autocomplete="off" class="modal_style">
          @csrf
          <div class="row">
            <div class="form-group mb-4 col-md-4">
              <label class="form-label" for="support_program_id">برنامج الدعم</label>
              <select name="support_program_id" class="form-control">
                <option selected value=""> اختر من القائمة </option>
                @foreach($supportPrograms as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-4 col-md-4">
              <label class="form-label">من تاريخ</label>
              <x-inputs.text type="date" name="from_date" value="" />
            </div>
            <div class="form-group mb-4 col-md-4">
              <label class="form-label">إلى تاريخ</label>
              <x-inputs.text type="date" name="to_date" value="" />
            </div>
            <div class="col-lg-2" style="margin-top: 30px">
              <button type="submit" class="button black x-small"><i class="fa fa-search"></i> بحث</button>
              <button type="button" class="button black x-small" onclick="resetForm()"><i class="fa fa-undo"></i> اعادة تعيين</button>
            </div>
          </div>
        </form>
        <br>
        <br>
        <div>
        </div>
        <br>
        <div id="results"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  function resetForm() {
    $('#searchForm input[type="date"]').val('');
    $('#searchForm select').val('').trigger('change');
    $('#results').empty();
  }

  $(document).ready(function() {
    $('#searchForm').on('submit', function(e) {
        e.preventDefault(); 
        var formData = $(this).serialize();
        $.ajax({
          url: "{{ route('admin.difficult-case-support-programs.search') }}", 
          method: "POST", 
          data: formData, 
          success: function(response) {
            $('#results').html(response); 
          },
          error: function(xhr) {
            var audio = new Audio('{{ asset("dashboard/assets/sounds/error-alert.mp3") }}');
                audio.play().catch(function (e) {
                    console.warn("لم يتم تشغيل الصوت:", e);
                });
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.message) {
              toastr.error(xhr.responseJSON.message);
            } else {
              toastr.error('حدث خطأ أثناء البحث.');
            }
          }
        });
      });
  });
</script>
@endpush