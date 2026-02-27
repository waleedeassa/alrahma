@extends('layouts.master')
@section('title', 'تفاصيل تقرير اليتيم')
@section('breadcrumpTitle','تفاصيل تقرير اليتيم')
@section("breadcrump")
@parent
<li class="breadcrumb-item active">تفاصيل تقرير اليتيم</li>
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
          <a href="{{ route('admin.orphan-report.edit', $orphanReport->id) }}" class="button x-small editButton">
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
                <h3>تقرير اليتيم</h3>
              </div>
              <div class="logo">
                <img src="{{ asset('dashboard/assets/images/logo/logo.jpg') }}" alt="مؤسسة الرحمة" class="logo-img" style="width: 100px; height: auto;">
              </div>
            </div>
          </header>
          <div class="main">
            <div class="container">
              <div class="orphan-data">

                <h5> البيانات الأساسية والصحية : Informations de base et santé </h5>
                <div class="line">
                  <label>اسم اليتيم</label>
                  <input type="text" class="grow" value="{{ $orphanReport->orphan->name_ar ?? $orphanReport->orphan->name }}" readonly>

                  <label>اسم العائلة</label>
                  <input type="text" class="grow" value="{{ $orphanReport->orphan->family_name_ar ?? $orphanReport->orphan->family_name }}" readonly>
                </div>

                <div class="line">
                  <label>الحالة الصحية</label>
                  <input type="text" value="{{ $orphanReport->health_status_label }}" readonly>

                  <label>مدة الوصول إلى أقرب طبيب/مستشفى</label>
                  <input type="text" value="{{ $orphanReport->going_to_doctor_or_hospital_label }}" readonly>
                </div>

                <h5> البيانات التعليمية : Éducation </h5>
                <div class="line">
                  <label>المستوى التعليمي</label>
                  <input type="text" value="{{ $orphanReport->education_label }}" readonly>

                  <label>اسم المؤسسة</label>
                  <input type="text" value="{{ $orphanReport->school_name }}" readonly>
                </div>

                <div class="line">
                  <label>وسيلة الذهاب للمدرسة</label>
                  <input type="text" value="{{ $orphanReport->going_to_school_by_label }}" readonly>

                  <label>مدة الوصول للمدرسة</label>
                  <input type="text" value="{{ $orphanReport->going_to_nearest_school_time_label }}" readonly>
                </div>

                <div class="line">
                  <label>المادة المفضلة</label>
                  <input type="text" value="{{ $orphanReport->preferred_subject_label }}" readonly>

                  <label>المادة غير المفضلة</label>
                  <input type="text" value="{{ $orphanReport->unpreferred_subject_label }}" readonly>
                </div>

                <div class="line">
                  <label>معدل الدورة 1</label>
                  <input type="text" value="{{ $orphanReport->first_term_average }}" readonly>

                  <label>معدل الدورة 2</label>
                  <input type="text" value="{{ $orphanReport->second_term_average }}" readonly>
                </div>

                <div class="line">
                  <label>التقدم الدراسي</label>
                  <input type="text" value="{{ $orphanReport->school_progress_label }}" readonly>

                  <label>قرار نهاية السنة</label>
                  <input type="text" value="{{ $orphanReport->end_year_decision_label }}" readonly>
                </div>

                <div class="line">
                  <label>التغيرات الدراسية</label>
                  <input type="text" class="grow" value="{{ $orphanReport->educational_level_changes_label }}" readonly>
                </div>

                <h5> الجوانب الشخصية والمعيشية : Aspects personnels et vie </h5>
                <div class="line">
                  <label>الشخصية</label>
                  <input type="text" value="{{ $orphanReport->personal_label }}" readonly>

                  <label>يريد أن يصبح</label>
                  <input type="text" value="{{ $orphanReport->like_to_become_label }}" readonly>
                </div>

                <div class="line">
                  <label>الهوايات</label>
                  <input type="text" value="{{ $orphanReport->hobbies_label }}" readonly>

                  <label>الطعام المفضل</label>
                  <input type="text" value="{{ $orphanReport->favorite_food_label }}" readonly>
                </div>

                <div class="line">
                  <label>الطعام الأساسي</label>
                  <input type="text" value="{{ $orphanReport->basic_food_label }}" readonly>
                </div>

                <div class="line">
                  <label>جودة السكن</label>
                  <input type="text" value="{{ $orphanReport->quality_of_housing_label }}" readonly>

                  <label>مكان السكن</label>
                  <input type="text" value="{{ $orphanReport->dwelling_place_label }}" readonly>
                </div>

                <div class="line">
                  <label>نوع المسكن</label>
                  <input type="text" value="{{ $orphanReport->type_of_dwelling_label }}" readonly>
                </div>

                <h5>الملاحظات : Notes</h5>
                <div class="line">
                  <label>ملاحظات المشرف</label>
                  <input type="text" class="grow" value="{{ $orphanReport->supervisor_notes }}" readonly>
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