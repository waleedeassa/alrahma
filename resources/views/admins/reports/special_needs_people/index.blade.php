@extends('layouts.master')
@section('title', 'بحث ذوي الاحتياجات الخاصة')
@section('breadcrumpTitle', 'بحث ذوي الاحتياجات الخاصة')
@section('breadcrump')
@parent
<li class="breadcrumb-item active">بحث ذوي الاحتياجات الخاصة</li>
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
        <form action="{{ route('admin.special-needs-people.search') }}" method="POST" id="searchForm" role="search" autocomplete="off" class="modal_style">
          @csrf
          <div class="row">
            <div class="form-group mb-3 col-md-3">
              <x-inputs.select name="governorate_id" label="{{ 'اسم الإقليم' }}" :options="$governorates" />
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">المدينة / الجماعة</label>
              <select name="city_id">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">نوع الاحتياج الخاص</label>
              <select name="special_needs_type">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.special_needs_type') as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">الوضعية الاجتماعية</label>
              <select name="social_status" id="social_status">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.social_status') as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="gender">النوع</label>
              <select name="gender" id="gender" class="form-control">
                <option selected disabled>اختر من القائمة...</option>
                @foreach(config('options.gender') as $key => $label)
                <option value="{{ $key }}" @if(old('gender')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">المستوى الدراسي</label>
              <select name="education_level" id="education_level">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.education_level') as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3 col-md-3">
              <label class="form-label" for="exampleFormControlSelect1">عدد افراد الاسرة</label>
              <select name="family_members_count">
                <option selected disabled>{{ 'اختر من القائمة' }}...</option>
                @foreach(config('options.number_of_family_members') as $key => $label)
                <option value="{{ $key }}" @if(old('family_members_count')==$key) selected @endif>{{ $label }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-3" style="margin-top: 10px">
            <div>
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
        <div id="results">
          <!-- Results will be displayed here -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
{{-- Get governorate cities --}}
<script>
  $(document).ready(function() {
        $('select[name="governorate_id"]').on('change', function() {
            var governorate_id = $(this).val();
            if (governorate_id) {
                $.ajax({
                    url: "{{ URL::to('admin/get_cities') }}/" + governorate_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option selected disabled >{{ 'اختر من القائمة' }}...</option>');
                        $.each(data, function(key, value) {
                            $('select[name="city_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });

    function resetForm() {
        $('#searchForm input[type="text"], #searchForm input[type="number"]').val('');
        $('#searchForm select.select2').val(null).trigger('change');
        $('#searchForm select').not('.select2').prop('selectedIndex', 0);
        $('#results').empty();
    }

    $(document).ready(function() {
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $('#searchForm :input').filter(function() {
                return $(this).val() && $(this).val() !== '';
            }).serialize();

            $.ajax({
                url: "{{ route('admin.special-needs-people.search') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#results').html(response);
                },
                error: function(xhr) {
                    var audio = new Audio('{{ asset("dashboard/assets/sounds/error-alert.mp3") }}');
                    audio.play().catch(function(e) {
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