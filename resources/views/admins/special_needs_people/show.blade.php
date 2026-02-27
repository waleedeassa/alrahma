@extends('layouts.master')
@section('title', 'تفاصيل مريض - ذو احتياج خاص')
@section('breadcrumpTitle', 'عرض تفاصيل مريض - ذو احتياج خاص')

@section("breadcrump")
@parent
<li class="breadcrumb-item ">
  <a href="{{ route('admin.special-needs-people.index') }}" class="default-color">
    المرضى وذوي الاحتياجات الخاصة
  </a>
</li>
<li class="breadcrumb-item active">عرض تفاصيل مريض - ذو احتياج خاص</li>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/orphans-family-form.css') }}" />
<style>
  @media print {

    #print_Button,
    .breadcrumb,
    .main-header {
      display: none !important;
    }

    header .container {
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      min-height: 90px;
    }

    header .page-name {
      position: absolute;
      top: 70px;
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

        <button class="button black x-small" id="print_Button" onclick="printDiv()">
          <i class="fa fa-print"></i>{{ ' طباعه' }}
        </button>

        <div id="print">

          <header>
            <div class="container">
              <div class="title">
                <h6>المملكة المغربية</h6>
                <h6>مؤسسة الرحمة للتنمية الاجتماعية</h6>
                <h6>قسم المرضى وذوي الاحتياجات الخاصة</h6>
              </div>
              <div class="page-name">
                <h5>استمارة مريض / ذو احتياج خاص</h5>
              </div>
              <div class="logo">
                <img src="{{ asset('dashboard/assets/images/logo/logo.jpg') }}" alt="مؤسسة الرحمة" class="logo-img" style="width: 100px; height: auto;">
              </div>
            </div>
          </header>
          <div class="main">
            <div class="container">
              <div class="orphan-data">
                <h5>بيانات الحالة الأساسية</h5>
                <div class="line">
                  <label>رقم الحالة</label>
                  <input type="text" value="{{ $specialNeedsPerson->id }}" readonly>
                  <label>تاريخ التسجيل</label>
                  <input type="text" value="{{ $specialNeedsPerson->registration_date }}" readonly>
                </div>
                <div class="line">
                  <label>الاسم الشخصي بالعربية</label>
                  <input type="text" class="grow" value="{{ $specialNeedsPerson->first_name_ar }}" readonly>

                  <label>الاسم العائلي بالعربية</label>
                  <input type="text" class="grow" value="{{ $specialNeedsPerson->last_name_ar }}" readonly>
                </div>
                <div class="line">
                  <label>الاسم الشخصي بالفرنسية</label>
                  <input type="text" class="grow" value="{{ $specialNeedsPerson->first_name_fr }}" readonly>
                  <label>الاسم العائلي بالفرنسية</label>
                  <input type="text" class="grow" value="{{ $specialNeedsPerson->last_name_fr }}" readonly>
                </div>
                <div class="line">
                  <label>رقم البطاقة الوطنية</label>
                  <input type="text" value="{{ $specialNeedsPerson->national_id_no }}" readonly>
                  <label>النوع</label>
                  <input type="text" value="{{ $specialNeedsPerson->gender_label }}" readonly>
                  <label>تاريخ الازدياد</label>
                  <input type="text" value="{{ $specialNeedsPerson->birth_date }}" readonly>
                </div>
                <div class="line">
                  <label>المستوى الدراسي</label>
                  <input type="text" value="{{ $specialNeedsPerson->education_level_label }}" readonly>

                  <label>عدد أفراد الأسرة</label>
                  <input type="text" value="{{ $specialNeedsPerson->family_members_count_for_display }}" readonly>
                </div>
                <div class="line">
                  <label>نوع الاحتياج</label>
                  <input type="text" class="grow" value="{{ $specialNeedsPerson->special_needs_type_label }}" readonly>
                  <label>الوضعية الاجتماعية</label>
                  <input type="text" class="grow" value="{{ $specialNeedsPerson->social_status_label }}" readonly>
                </div>
                <br>
                <h5>المعلومات الجغرافية والاتصال</h5>
                <div class="line">
                  <label>الإقليم</label>
                  <input type="text" value="{{ $specialNeedsPerson->governorate->name ?? 'غير محدد' }}" readonly>
                  <label>المدينة / الجماعة</label>
                  <input type="text" value="{{ $specialNeedsPerson->city->name ?? 'غير محدد' }}" readonly>
                </div>
                <div class="line">
                  <label>العنوان الكامل</label>
                  <input type="text" class="grow" value="{{ $specialNeedsPerson->address }}" readonly>
                  <label>رقم الهاتف</label>
                  <input type="text" value="{{ $specialNeedsPerson->phone }}" readonly>
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