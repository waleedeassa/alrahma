@extends('layouts.master')
@section('title', 'تفاصيل تقرير الأسرة')
@section('breadcrumpTitle','تفاصيل تقرير الأسرة')
@section("breadcrump")
@parent
<li class="breadcrumb-item active">تفاصيل تقرير الأسرة</li>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/orphans-family-form.css') }}" />
<style>
  form {
    font-family: sans-serif;
  }

  table {
    text-align: center;
  }

  table>thead,
  table>tfoot {
    background-color: #dcdcdc;
  }

  @media print {
    body {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
      background-color: white !important;
    }

    @page {
      margin: 1cm 0.5cm;
      size: auto;
    }

    input[type="text"],
    input[type="number"],
    .form-control {
      border: 1px solid #000 !important;
      background-color: #fff !important;
      color: #000 !important;
      border-radius: 4px !important;
      padding: 5px !important;
      box-shadow: none !important;
      height: auto !important;
    }

    table,
    th,
    td {
      border: 1px solid #000 !important;
      border-collapse: collapse !important;
    }

    header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      direction: rtl;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .orphan-data .line {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .orphan-data label {
      font-weight: bold;
      margin-left: 5px;
    }

    .no-print,
    .editButton {
      display: none !important;
    }
  }
</style>
@endpush
@section('content')
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
        <div class="mb-3 text-left no-print">
          <button class="button black x-small editButton" onclick="printReport()">
            <i class="fa fa-print"></i> طباعة
          </button>
          <a href="{{ route('admin.family-report.edit', $familyReport->id) }}" class="button x-small editButton">
            <i class="fa fa-edit"></i> تعديل
          </a>
        </div>
        <div id="print">
          <header>
            <div class="container">
              <div class="title">
                <h6>المملكة المغربية</h6>
                <h6> مؤسسة الرحمة للتنمية الاجتماعية</h6>
                <h6>قسم الأسر و الأيتام</h6>
              </div>
              <div class="page-name">
                <h3>تقرير حالة أسرة</h3>
              </div>
              <div class="logo">
                <img src="{{ asset('dashboard/assets/images/logo/logo.jpg') }}" alt="مؤسسة الرحمة" class="logo-img" style="width: 100px; height: auto;">
              </div>
            </div>
          </header>
          <div class="main">
            <div class="container">
              <div class="orphan-data">
                <h5> بيانات الأسرة : Informations sur la famille</h5>
                <div class="line">
                  <label> اسم ولي أمر اليتيم </label>
                  <input type="text" class="grow" value="{{ $familyReport->family->orphan_guardian_name }}" readonly>

                  <label>تاريخ التقرير</label>
                  <input type="text" value="{{ $familyReport->created_at->format('Y-m-d') }}" readonly>
                </div>
                <div class="line">
                  <label>الإقليم </label>
                  <input type="text" value="{{ $familyReport->family->governorate->name ?? '-' }}" readonly>
                  <label>المدينة</label>
                  <input type="text" value="{{ $familyReport->family->city->name ?? '-' }}" readonly>
                </div>
                <h5> معلومات السكن والمعيشة : Logement et subsistance</h5>
                <div class="line">
                  <label>المؤونة</label>
                  <input type="text" value="{{ $familyReport->sufficiency_label }}" readonly>
                  <label>الطعام الأساسي للأسرة</label>
                  <input type="text" class="grow" value="{{ $familyReport->basic_food }}" readonly>
                </div>
                <div class="line">
                  <label>مدة الوصول إلى أقرب طبيب</label>
                  <input type="text" value="{{ $familyReport->time_to_doctor_label }}" readonly>
                  <label>مدة الوصول إلى أقرب مستشفى</label>
                  <input type="text" value="{{ $familyReport->time_to_hospital_label }}" readonly>
                </div>
                <h5> تجهيزات المسكن والبنية التحتية : Équipements du logement</h5>
                <div class="line">
                  <label>قناة الصرف الصحي</label>
                  <input type="text" value="{{ $familyReport->sewage_system_label }}" readonly>
                  <label>شبكة توزيع الكهرباء</label>
                  <input type="text" value="{{ $familyReport->electricity_network_label }}" readonly>
                </div>
                <div class="line">
                  <label>شبكة توزيع الماء</label>
                  <input type="text" value="{{ $familyReport->water_network_label }}" readonly>
                  <label>المطبخ</label>
                  <input type="text" value="{{ $familyReport->kitchen_setup_label }}" readonly>
                </div>
                <div class="line">
                  <label>وسيلة الطهي</label>
                  <input type="text" value="{{ $familyReport->cooking_method_label }}" readonly>
                  <label>حمام</label>
                  <input type="text" value="{{ $familyReport->bathroom_setup_label }}" readonly>
                </div>
                <h5> الأثاث والأجهزة : Meubles et appareils</h5>
                <div class="line">
                  <label>ثلاجة</label>
                  <input type="text" value="{{ $familyReport->refrigerator_condition_label }}" readonly>
                  <label>خزانة ملابس</label>
                  <input type="text" value="{{ $familyReport->wardrobe_condition_label }}" readonly>
                  <label>سرير</label>
                  <input type="text" value="{{ $familyReport->bed_condition_label }}" readonly>
                </div>
                <div class="line">
                  <label>صالون</label>
                  <input type="text" value="{{ $familyReport->salon_condition_label }}" readonly>
                  <label>تلفاز</label>
                  <input type="text" value="{{ $familyReport->has_tv_label }}" readonly>
                  <label>حاسوب</label>
                  <input type="text" value="{{ $familyReport->has_computer_label }}" readonly>
                </div>
                <div class="line">
                  <label>هاتف نقال</label>
                  <input type="text" value="{{ $familyReport->has_mobile_phone_label }}" readonly>
                </div>
                <h5> الملابس والأغطية : Vêtements et couvertures</h5>
                <div class="line">
                  <label>أغطية</label>
                  <input type="text" value="{{ $familyReport->blankets_sufficiency_label }}" readonly>
                  <label>اللباس الشتوي</label>
                  <input type="text" value="{{ $familyReport->winter_clothes_sufficiency_label }}" readonly>
                  <label>اللباس الصيفي</label>
                  <input type="text" value="{{ $familyReport->summer_clothes_sufficiency_label }}" readonly>
                </div>
                <h5> الجانب الاجتماعي والمعيشي : Aspect social et vie</h5>
                <div class="line">
                  <label>استفادة الأسرة (محفظة، قفة، أضحية...)</label>
                  <input type="text" class="grow" value="{{ $familyReport->benefits_received_details }}" readonly>
                </div>
                <div class="line">
                  <label>هل يستفيدون من الأنشطة التربوية؟ </label>
                  <input type="text" value="{{ $familyReport->educational_activities_benefit_label }}" readonly>

                  @if($familyReport->educational_activities_reason)
                  <label style="color: #dc3545;">ما السبب؟</label>
                  <input type="text" class="grow" value="{{ $familyReport->educational_activities_reason }}" readonly style="color: #dc3545;">
                  @endif
                </div>

                <div class="line">
                  <label>هل تزوج أو تطلق أحد أفراد الأسرة؟ </label>
                  <input type="text" class="grow" value="{{ $familyReport->family_changes_marriage_divorce }}" readonly>
                </div>
                <div class="line">
                  <label>هل اشتغل أحد أفراد الأسرة؟ </label>
                  <input type="text" class="grow" value="{{ $familyReport->family_changes_employment }}" readonly>
                </div>
                <div class="line">
                  <label>هل غيرت الأسرة مكان السكن ؟</label>
                  <input type="text" class="grow" value="{{ $familyReport->family_changes_relocation }}" readonly>
                </div>
                <div class="line">
                  <label>هل هناك أي إصلاحات في البيت؟</label>
                  <input type="text" class="grow" value="{{ $familyReport->home_repairs_details }}" readonly>
                </div>
                <div class="line">
                  <label>هل اشترت الأسرة أي أثاث جديد أو معدات للمطبخ؟</label>
                  <input type="text" class="grow" value="{{ $familyReport->new_furniture_details }}" readonly>
                </div>
                <div class="line">
                  <label>فيم تصرف الكفالة</label>
                  <input type="text" class="grow" value="{{ $familyReport->sponsorship_spending }}" readonly>
                </div>
                <div class="line">
                  <label> كيف أمضت الأسرة هذه السنة؟</label>
                  <input type="text" class="grow" value="{{ $familyReport->family_year_summary }}" readonly>
                </div>
                <div class="line">
                  <label>أمنية الأسرة واليتيم</label>
                  <input type="text" class="grow" value="{{ $familyReport->family_orphan_wish }}" readonly>
                </div>
                <br>
                <div class="line">
                  <label>تغيرات الأسرة بعد الكفالة:</label>
                  <input type="text" class="grow" value="{{ $familyReport->family_changes_after_sponsored_label }}" readonly>
                </div>
                <div class="line">
                  <label>تغيرات الأسرة بعد الكفالة 2:</label>
                  <input type="text" class="grow" value="{{ $familyReport->family_changes_after_sponsored_label2 }}" readonly>
                </div>
                <div class="line">
                  <label>تغيرات الأسرة بعد الكفالة 3:</label>
                  <input type="text" class="grow" value="{{ $familyReport->family_changes_after_sponsored_label3 }}" readonly>
                </div>
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
  function printReport() {
    var originalContents = document.body.innerHTML;
    var printContents = document.getElementById('print').innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
  }
</script>
@endpush