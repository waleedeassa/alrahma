@extends('layouts.master')
@section('title', "إضافة أيتام إالى كفيل")
@section('breadcrumpTitle', "إضافة أيتام إالى كفيل")
@section('breadcrump')
@parent
<li class="breadcrumb-item active">إضافة أيتام إالى كفيل</li>
@endsection
@push('css')
<style>
  .duplicate-row {
    background-color: #ffe6e6 !important;
  }
  
  .duplicate-warning {
    font-size: 13px;
    margin-top: 5px;
  }
  
  .invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
    bottom: 0;
    left: 0;
  }
  
  .is-invalid {
    border-color: #dc3545 !important;
  }
</style>
@endpush
@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      @if ($errors->any())
      <div class="alert alert-danger m-3">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card-body">
        <form action="{{ route('admin.assign-orphans-to-sponsor.store') }}" id="assignOrphansForm" class="modal_style" method="POST">
          @csrf
          <div class="row">
            <div class="form-group mb-4 col-md-12">
              <label for="sponsor_id" class="form-label">اسم الكفيل</label>
              <select name="sponsor_id" id="sponsor_id" class="form-control select2 required">
                <option selected disabled value="">اختر الكفيل...</option>
                @foreach ($sponsors as $sponsor)
                {{-- <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option> --}}
                <option value="{{ $sponsor->id }}" {{ old('sponsor_id') == $sponsor->id ? 'selected' : '' }}>
                  {{ $sponsor->name }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <br>
          <!--Orphan Table -->
          <div class="table-responsive">
            <table class="table" >
              <thead>
                <tr>
                  <th style="width: 80px">حذف</th>
                  <th style="width: 60px">#</th>
                  <th>اسم اليتيم</th>
                  <th style="width: 250px">رمز اليتيم</th>
                </tr>
              </thead>
              <tbody id="repeaterRows">
                @php
                $oldOrphans = old("orphan_ids", []);
                $oldCodes = old("sponsorship_codes", []);
                @endphp

                @if(count($oldOrphans) > 0)
                @foreach($oldOrphans as $index => $orphanId)
                <tr class="cloning_row" id="{{ $index }}">
                  <td>
                    @if($index > 0)
                    <button type="button" class="btn btn-danger btn-sm delgated-btn">
                      <i class="fa fa-trash"></i>
                    </button>
                    @endif
                  </td>
                  <td class="row-number">{{ $index + 1 }}</td>
                  <td>
                    <select name="orphan_ids[{{ $index }}]" class="orphan-select form-control">
                      <option value="">اختر من القائمة</option>
                      @foreach($unsponsoredOrphans as $orphan)
                      <option value="{{ $orphan->id }}" {{ $orphanId==$orphan->id ? 'selected' : '' }}>{{ $orphan->name_ar . ' ' .  $orphan->family_name_ar }}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                  </td>
                  <td>
                    <input name="sponsorship_codes[{{ $index }}]" value="{{ $oldCodes[$index] ?? '' }}" class="sponsorship-code form-control" type="text" />
                    <div class="invalid-feedback"></div>
                  </td>
                </tr>
                @endforeach
                @else
                <tr class="cloning_row" id="0">
                  <td></td>
                  <td class="row-number">1</td>
                  <td>
                    <select name="orphan_ids[0]" class="orphan-select form-control">
                      <option value="">اختر من القائمة</option>
                      @foreach($unsponsoredOrphans as $orphan)
                      <option value="{{ $orphan->id }}">{{ $orphan->name_ar . ' ' .  $orphan->family_name_ar}}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                  </td>
                  <td>
                    <input name="sponsorship_codes[0]" class="sponsorship-code form-control" type="text" />
                    <div class="invalid-feedback"></div>
                  </td>
                </tr>
                @endif
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5" class="text-start">
                    <button type="button" class="button black x-small btn_add">اضافة يتيم</button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="text-start pt-3">
            <button type="submit" class="button black x-small"> <i class="fa fa-floppy-o"></i>&nbsp; حفظ</button>
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
    // Store orphan options
    let orphansOptions = `
        <option value="">اختر من القائمة</option>
        @foreach($unsponsoredOrphans as $orphan)
        <option value="{{ $orphan->id }}">{{ $orphan->name_ar . ' ' .  $orphan->family_name_ar }}</option>
        @endforeach
    `;
    // Initialize Select2
    function initializeSelect2() {
        if ($.fn.select2) {
            $(".select2, .orphan-select").select2({theme: "bootstrap4", width: "100%"});
        }
    }
    // Initialize Select2 on page load
    initializeSelect2();
    // Form validation setup
    const validator = $("#assignOrphansForm").validate({
        rules: {sponsor_id: {required: true}},
        messages: {sponsor_id: {required: "الحقل مطلوب"}},
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            if (element.closest("tr").length) {
                let errorContainer = element.closest("td").find(".invalid-feedback");
                if (errorContainer.length === 0) {
                    errorContainer = $("<div class=\"invalid-feedback\"></div>");
                    element.after(errorContainer);
                }
                errorContainer.html(error);
            } else {
                element.closest(".form-group").append(error);
            }
        },
        highlight: function(element) {$(element).addClass("is-invalid");},
        unhighlight: function(element) {$(element).removeClass("is-invalid");}
    });
    // Add validation rules for existing rows
    $("#repeaterRows tr").each(function(index) {addValidationRules(index);});
    // Add validation rules for specific row
    function addValidationRules(index) {
        $(`[name="orphan_ids[${index}]"]`).rules("add", {required: true, messages: {required: "الحقل مطلوب"}});
        $(`[name="sponsorship_codes[${index}]"]`).rules("add", {required: true, messages: {required: "الحقل مطلوب"}});
    }
    // Check for duplicate orphans
    function checkDuplicateOrphans() {
        const rows = $("#repeaterRows tr");
        const selectedOrphans = new Map();
        let hasDuplicate = false;
        // Remove previous duplicate formatting
        rows.removeClass("duplicate-row");
        rows.find(".duplicate-warning").remove();
        // Check for duplicates
        rows.each(function(index, row) {
            const $row = $(row);
            const orphanSelect = $row.find("select[name^=\"orphan_ids\"]");
            const orphanId = orphanSelect.val();
            
            if (orphanId && orphanId !== "") {
                if (selectedOrphans.has(orphanId)) {
                    hasDuplicate = true;
                    $row.addClass("duplicate-row");
                    selectedOrphans.get(orphanId).addClass("duplicate-row");
                    // Add error message
                    if ($row.find(".duplicate-warning").length === 0) {
                        $row.find("td:eq(2)").append(`<div class="text-danger small duplicate-warning">هذا اليتيم مكرر</div>`);
                    }
                    if (selectedOrphans.get(orphanId).find(".duplicate-warning").length === 0) {
                        selectedOrphans.get(orphanId).find("td:eq(2)").append(`<div class="text-danger small duplicate-warning">هذا اليتيم مكرر</div>`);
                    }
                } else {
                    selectedOrphans.set(orphanId, $row);
                }
            }
        });
        
        if (hasDuplicate) {
            toastr.error("لا يمكن تكرار نفس اليتيم مرتين");
            var audio = new Audio("{{ asset('dashboard/assets/sounds/error-alert.mp3') }}");
            audio.play().catch(function (e) {console.warn("Audio playback failed:", e);});
            
            $("html, body").animate({scrollTop: $(".duplicate-row").first().offset().top - 100}, 500);
        }
        return !hasDuplicate;
    }
    // Update row numbers
    function updateRowNumbers() {
        $("#repeaterRows tr").each(function(index) {$(this).find(".row-number").text(index + 1);});
    }
    // Add new row
    function addNewRow() {
        const rowCount = $("#repeaterRows tr").length;
        const newRow = `
            <tr class="cloning_row" id="${rowCount}">
                <td><button type="button" class="btn btn-danger btn-sm delgated-btn"><i class="fa fa-trash"></i></button></td>
                <td class="row-number">${rowCount + 1}</td>
                <td>
                    <select name="orphan_ids[${rowCount}]" class="orphan-select form-control">${orphansOptions}</select>
                    <div class="invalid-feedback"></div>
                </td>
                <td>
                    <input name="sponsorship_codes[${rowCount}]" type="text" class="sponsorship-code form-control" />
                    <div class="invalid-feedback"></div>
                </td>
            </tr>`;
        
        $("#repeaterRows").append(newRow);
        // Initialize Select2 for new row
        $(`#${rowCount} .orphan-select`).select2({theme: "bootstrap4", width: "100%"});
        // Add validation rules for new row
        addValidationRules(rowCount);
        // Update row numbers
        updateRowNumbers();
    }
    
    // Add new row button click event
    $(document).on("click", ".btn_add", function() {addNewRow();});
    
    // Delete row button click event
    $(document).on("click", ".delgated-btn", function() {
        $(this).closest("tr").remove();
        updateRowNumbers();
        checkDuplicateOrphans();
    });
    // Orphan select change event for duplicate checking
    $(document).on("change", ".orphan-select", function() {checkDuplicateOrphans();});
    // Form submission validation
    $("#assignOrphansForm").on("submit", function(e) {
        if (!checkDuplicateOrphans() || !$(this).valid()) {
            e.preventDefault();
            return false;
        }
        return true;
    });
    // Update row numbers on page load
    updateRowNumbers();
});
</script>
@endpush
