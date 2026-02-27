@extends('layouts.master')
@section('title', 'تفاصيل حالة صعبة')
@section('breadcrumpTitle', 'عرض تفاصيل حالة صعبة')
@section("breadcrump")
@parent
<li class="breadcrumb-item "><a href="{{ route("admin.difficult-case-families.index") }}" class="default-color">
  الأسر فى وضعية صعبة</a></li>
<li class="breadcrumb-item active">عرض تفاصيل حالة صعبة</li>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/orphans-family-form.css') }}" />
<style>
  @media print {
      #print_Button, .breadcrumb, .main-header {
          display: none !important;
      }
      header .container {
          position: relative;
          display: flex;
          justify-content: space-between;
          align-items: center;
      }
      header .page-name {
          position: absolute;
          left: 50%;
          transform: translateX(-50%);
          width: 100%;
          text-align: center;
      }
  }
</style>
@endpush

@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <button class="button black x-small" id="print_Button" onclick="printDiv()"> <i class="fa fa-print"></i>{{' طباعه' }}</button>
        <div id="print">
          <header>
            <div class="container">
              <div class="title">
                <h6>المملكة المغربية</h6>
                <h6> مؤسسة الرحمة للتنمية الاجتماعية</h6>
                <h6>قسم الأسر فى وضعية صعبة</h6>
              </div>
              <div class="page-name">
                <h3>استمارة حالة صعبة</h3>
              </div>
              <div class="logo">
                <img src="{{ asset('dashboard/assets/images/logo/logo.jpg') }}" alt="مؤسسة الرحمة" class="logo-img" style="width: 100px; height: auto;" >
              </div>
            </div>
          </header>

          <div class="main">
            <div class="container">
              <div class="orphan-data">
                <h5> بيانات الحالة الأساسية</h5>
                <div class="line">
                  <label>رقم الحالة</label>
                  <input type="text" value="{{ $difficultCaseFamily->id }}" readonly>
                  <label>تاريخ التسجيل</label>
                  <input type="text" value="{{ $difficultCaseFamily->registration_date }}" readonly>
                </div>
                <div class="line">
                  <label>الاسم الشخصي بالعربية</label>
                  <input type="text" class="grow" value="{{ $difficultCaseFamily->first_name_ar }}" readonly>
                  <label>الاسم العائلى بالعربية</label>
                  <input type="text" class="grow" value=" {{ $difficultCaseFamily->last_name_ar }}" readonly>
                </div>
                <div class="line">
                  <label>الاسم الشخصي بالفرنسية</label>
                  <input type="text" class="grow" value="{{ $difficultCaseFamily->first_name_fr }}" readonly>
                  <label>الاسم العائلى بالفرنسية</label>
                  <input type="text" class="grow" value=" {{ $difficultCaseFamily->last_name_fr }}" readonly>
                </div>
                <div class="line">
                  <label>رقم البطاقة الوطنية</label>
                  <input type="text" value="{{ $difficultCaseFamily->national_id_no }}" readonly>
                  <label>النوع</label>
                  <input type="text" value="{{ $difficultCaseFamily->gender_label }}" readonly>
                  <label>تاريخ الازدياد</label>
                  <input type="text" value="{{ $difficultCaseFamily->birth_date }}" readonly>
                </div>
                <div class="line">
                  <label>المستوى الدراسي</label>
                  <input type="text" value="{{ $difficultCaseFamily->education_level_label }}" readonly>
                  <label>عدد أفراد الأسرة</label>
                  <input type="text" value="{{ $difficultCaseFamily->family_members_count_for_display }}" readonly>
                </div>
                <div class="line">
                  <label>فئة الحالة</label>
                  <input type="text" class="grow" value="{{ $difficultCaseFamily->difficult_case_type_label }}" readonly>
                  <label>الوضعية الاجتماعية</label>
                  <input type="text" class="grow" value="{{ $difficultCaseFamily->social_status_label }}" readonly>
                </div>
                <br>
                <h5> المعلومات الجغرافية والاتصال</h5>
                <div class="line">
                  <label>الإقليم</label>
                  <input type="text" value="{{ $difficultCaseFamily->governorate->name ?? 'غير محدد' }}" readonly>
                  <label>المدينة/الجماعة</label>
                  <input type="text" value="{{ $difficultCaseFamily->city->name ?? 'غير محدد' }}" readonly>
                </div>
                <div class="line">
                  <label>العنوان الكامل</label>
                  <input type="text" class="grow" value="{{ $difficultCaseFamily->address }}" readonly>
                  <label>رقم الهاتف</label>
                  <input type="text" value="{{ $difficultCaseFamily->phone }}" readonly>
                </div>
                <br>
                
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
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); 
    }
</script>
@endpush