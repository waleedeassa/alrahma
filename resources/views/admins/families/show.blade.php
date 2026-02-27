@extends('layouts.master')
@section('title', "تفاصيل الأسرة")
@section('breadcrumpTitle', "تفاصيل الأسرة")
@section("breadcrump")
@parent
<li class="breadcrumb-item "><a href="{{ route('admin.families.index') }}" class="default-color">الأسر</a></li>
<li class="breadcrumb-item active">تفاصيل الأسرة</li>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/orphans-family-form.css') }}" />
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
</style>

<style>
  @media print {
    @media print {

      #print_Button,
      .breadcrumb {
        display: none !important;
      }

      header .container {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      header .container>div {
        flex: none;
      }

      header .page-name {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
      }

    }
  }
</style>
@endpush
@section('content')
<div class="col-xl-12 mb-30">
  <div class="card card-statistics h-100">
    <div class="card-body">
      <div class="tab">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active show" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">معلومات الأسرة </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="attachments-tab" data-bs-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">المرفقات</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="orphans-tab" data-bs-toggle="tab" href="#orphans" role="tab" aria-controls="orphans" aria-selected="false">الأبناء </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="reports-tab" data-bs-toggle="tab" href="#reports" role="tab" aria-controls="reports" aria-selected="false">التقارير الدوريه</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
            <button class="button black x-small" id="print_Button" onclick="printDiv()"> <i class="fa fa-print"></i>{{' طباعه' }}</button>
            <div class="card-body" id="print">
              <header>
                <div class="container">
                  <div class="title">
                    <h6>المملكة المغربية</h6>
                    <h6> مؤسسة الرحمة للتنمية الاجتماعية</h6>
                    <h6>قسم الأسر و الأيتام</h6>
                  </div>
                  <div class="page-name">
                    <h3>استمارة الأسرة</h3>
                  </div>
                  <div class="logo">
                    <img src="{{ asset('dashboard\assets\images\logo/logo.jpg') }}" alt="مؤسسة الرحمة" class="logo-img" style="width: 100px; height: auto;">
                  </div>
                </div>
              </header>

              <div class="main">
                <div class="container">
                  <div class="orphan-data">
                    {{-- <form action="" method=""> --}}
                      <h5> بيانات الأسرة : Renseignements de family</h5>
                      <div class="line">
                        <label> اسم ولي أمر اليتيم </label>
                        <input type="text" class="grow" value="{{ $family->orphan_guardian_name }}" readonly>

                        <label>الحساب البنكى</label>
                        <input type="text" class="grow" value="{{ $family->bank_account_number }}" readonly>
                      </div>
                      <div class="line">
                        <label>رقم الهاتف الثابت</label>
                        <input type="text" value="{{ $family->phone1 }}" readonly>
                        <label> العنوان الكامل </label>
                        <input type="text" class="grow" value="{{ $family->address }}" readonly>
                        <label> عدد أفراد الاسرة</label>
                        <input type="text" value="{{ $family->family_members_for_display  }}" readonly>
                      </div>
                      <div class="line">
                        <label> التغطية الصحية</label>
                        <input type="text" value="{{ $family->medical_insurance_label }}" readonly>
                        <label>الإقليم </label>
                        <input type="text" value="{{ $family->governorate->name }}" readonly>
                        <label>المدينة</label>
                        <input type="text" value="{{ $family->city->name }}" readonly>
                      </div>
                      <br>

                      <h5> معلومات الأب المتوفى : Informations concernant le père décédé </h5>
                      <div class="line">
                        <label> مهنة الأب المتوفى</label>
                        <input type="text" value="{{ $family->father_job }}" readonly>
                        <label> سبب وفاة الأب </label>
                        <input type="text" value="{{ $family->father_death_reason_label}}" readonly>
                        <label> تاريخ وفاة الأب </label>
                        <input type="text" value="{{ $family->father_death_date}}" readonly>
                      </div>
                      <br>
                      <h5> معلومات الأم : Renseignements de la mère </h5>
                      <div class="line">
                        <label> هل الأم متوفيه</label>
                        <input type="text" value="{{ $family->mother_alive_label}}" readonly>
                        <label> هل العائلة تتوفر على معيل؟</label>
                        <input type="text" value="{{ $family->has_breadwinner_label}}" readonly>
                      </div>
                      <div class="line">
                        <label> اسم الأم بالعربية </label>
                        <input type="text" value="{{ $family->mother_name }}" readonly>
                        <label> نسب الأم بالعربية </label>
                        <input type="text" value="{{ $family->mother_family_name }}" readonly>
                      </div>
                      <div class="line">
                        <label> اسم الأم بالفرنسية </label>
                        <input type="text" value="{{ $family->mother_name_in_french}}" readonly>
                        <label> نسب الأم بالفرنسية </label>
                        <input type="text" value="{{ $family->mother_family_name_in_french}}" readonly>
                      </div>
                      <div class="line">
                        <label> رقم البطاقة الوطنيه للأم</label>
                        <input type="text" value="{{ $family->mother_id_no}}" readonly>
                        <label> المستوى الدراسي</label>
                        <input type="text" value="{{ $family->mother_education_level_label}}" readonly>
                      </div>
                      <div class="line">
                        <label> الحالة الصحية للأم</label>
                        <input type="text" value="{{ $family->mother_health_status_label}}" readonly>
                        <label> تاريخ ازدياد الأم</label>
                        <input type="text" value="{{ $family->mother_birth_date}}" readonly>
                      </div>
                      <div class="line">
                        <label> المؤهلات المهنية و الحرفية</label>
                        <input type="text" value="{{ $family->mother_qualifications_label}}" readonly>
                        <label> هل تعمل الأم ؟</label>
                        <input type="text" value="{{ $family->does_mother_work_label }}" readonly>
                      </div>
                      <br>
                      <h5> الدعم والاستفادات الحالية للأسرة : Soutien et prestations actuels pour la famille</h5>
                      <div class="line">
                        <label> هل تستفيد من دعم الأرامل ؟</label>
                        <input type="text" value="{{ $family->mother_widows_support_label }}" readonly>
                        <label>مبلغ الدعم للأم</label>
                        <input type="text" value="{{ $family->mother_widows_support_amount}}" readonly>
                      </div>
                      <div class="line">
                        <label> هل تستفيد الأسرة من تعويض تقاعد الزوج؟</label>
                        <input type="text" value="{{ $family->has_retirement_compensation_label }}" readonly>
                      </div>
                      <div class="line">
                        <label>المبلغ الشهري من تعويض تقاعد الزوج</label>
                        <input type="text" value="{{ $family->mother_widows_support_amount}}" readonly>
                      </div>
                      <div class="line">
                        <label>هل للأرملة مصدر آخر للدخل ؟</label>
                        <input type="text" value="{{ $family->is_there_another_source_of_income_label}}" readonly>
                        <label> مصدر الدخل الاخر</label>
                        <input type="text" value="{{ $family->mother_other_income_type_label }}" readonly>
                      </div>
                      <div class="line">
                        <label>المبلغ الشهري للدخل الأخر</label>
                        <input type="text" value="{{ $family->mother_other_income_amount}}" readonly>
                        <label> هل الدخل قار ؟</label>
                        <input type="text" value="{{ $family->is_mother_other_income_fixed_label}}" readonly>
                      </div>
                      <br>
                      <h5> بيانات السكن : Renseignements de logement</h5>
                      <div class="line">
                        <label>صفة حيازة المسكن</label>
                        <input type="text" value="{{ $family->housing_ownership_label }}" readonly>
                        <label> نوع السكن</label>
                        <input type="text" value="{{ $family->housing_type_label}}" readonly>
                      </div>
                      <div class="line">
                        <label> حالة السكن</label>
                        <input type="text" value="{{ $family->housing_status_label}}" readonly>
                        <label> مجال السكن</label>
                        <input type="text" value="{{ $family->housing_area_label}}" readonly>
                      </div>
                      <br>
                      @if ( $family->breadwinner_name)
                      <h5> معلومات المعيل : Renseignements du soutien de famille</h5>
                      <div class="line">
                        <label>اسم المعيل بالعربي </label>
                        <input type="text" value="{{ $family->breadwinner_name}}" readonly>
                        <label>نسب المعيل بالعربيه </label>
                        <input type="text" value="{{ $family->breadwinner_family_name}}" readonly>
                      </div>
                      <div class="line">
                        <label>اسم المعيل بالفرنسية </label>
                        <input type="text" value="{{ $family->breadwinner_french_name}}" readonly>
                        <label>نسب المعيل بالفرنسية </label>
                        <input type="text" value="{{ $family->breadwinner_family_in_french}}" readonly>
                      </div>
                      <div class="line">
                        <label>رقم هاتف المعيل</label>
                        <input type="text" value="{{ $family->breadwinner_phone}}" readonly>
                        <label>مهنة المعيل</label>
                        <input type="text" value="{{ $family->breadwinner_job}}" readonly>
                      </div>
                      <div class="line">
                        <label>رقم البطاقة الوطنية للمعيل</label>
                        <input type="text" value="{{ $family->breadwinner_id_no}}" readonly>
                      </div>
                      @endif
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- attachments tab --}}
          <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
            <div class="form-group mb-3 col-md-12">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered p-0" style="text-align: center">
                    <thead>
                      <tr class="table-head">
                        <th scope="col">#</th>
                        <th scope="col">اسم الملف</th>
                        <th scope="col">تاريخ الإنشاء</th>
                        <th scope="col">العمليات</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($family->attachments as $attachment)
                      <tr style='text-align:center;vertical-align:middle'>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attachment->original_name }}</td>
                        <td>{{ $attachment->created_at->diffForHumans() }}</td>
                        <td>
                          {{-- @can('عرض مرفقات الأسرة') --}}
                          <a class="btn btn-dark btn-sm" href="{{ route('admin.view_family_attachment', $attachment) }}" target="_blank" role="button"><i class="fa fa-eye"></i>&nbsp;{{ 'عرض' }}</a>
                          {{-- @endcan --}}

                          {{-- @can('تحميل مرفقات الأسرة') --}}
                          <a class="btn btn-success btn-sm" href="{{ route('admin.download_family_attachment', [$family->id, $attachment->file_name]) }}" role="button"><i class="fa fa-cloud-download"></i>&nbsp;{{ 'تحميل' }}</a>
                          {{-- @endcan --}}

                          {{-- @can('حذف مرفقات الأسرة') --}}
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete_img{{ $attachment->id  }}" title="حذف"><i class="fa fa-trash"></i>&nbsp;{{'حذف'}}</button>
                          {{-- @endcan --}}

                        </td>
                      </tr>

                      <div class="modal fade" id="Delete_img{{ $attachment->id  }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ 'حذف المرفقات' }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.delete_family_attachment', [$family->id, $attachment->file_name] ) }}" method="post">
                                @csrf
                                {{'هل أنت متأكد من حذف المرفق ؟' }}
                                <input type="hidden" name="id" value="{{ $attachment->id  }}">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{'اغلاق'}}</button>
                              <button class="btn btn-success">{{'موافق'}}</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          {{-- orphans --}}
          <div class="tab-pane fade" id="orphans" role="tabpanel" aria-labelledby="orphans-tab">
            <div class="form-group mb-3 col-md-12">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered p-0" style="text-align: center">
                    <thead>
                      <tr class="table-head">
                        <th scope="col">#</th>
                        <th scope="col">صورة اليتيم</th>
                        <th scope="col">رقم اليتيم</th>
                        <th scope="col">اسم اليتيم</th>
                        <th scope="col">اسم العائلة </th>
                        <th scope="col"> عمر اليتيم </th>
                        <th scope="col">العمليات</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($family->orphans as $orphan)
                      <tr style='text-align:center;vertical-align:middle'>
                        <td>{{ $loop->iteration }}</td>
                        <td>  <img src="{{ $orphan->image_url }}" width="50" height="50" class="rounded-circle avatar-lg" style="object-fit: cover;" alt="orphan-image"></td>
                        <td>{{ $orphan->id }}</td>
                        <td>{{ $orphan->name_ar }}</td>
                        <td>{{ $orphan->family_name_ar }}</td>
                        <td>{{ $orphan->age_label }}</td>
                        <td>
                          <a href="{{route('admin.orphans.show',$orphan)}}" class="btn btn-lg rounded-pill waves-effect waves-light" target="_blank" title=" معاينة "><i class="fa fa-eye"></i> </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="report-tab">
            {{-- @can('إضافة تقرير أسرة') --}}
            <a class="button black x-small" href="{{ route('admin.family-report.create',$family) }}" target="_blank"> <i class="fa fa-plus"></i>{{' اضافة تقرير دورى' }}</a>
            {{-- @endcan --}}
            <div class="form-group mb-3 col-md-12">
              <div class="card-body">
                <div class="table-responsive" id="print5">
                  <table class="table">
                    <thead>
                      <tr class="table-head">
                        <th>#</th>
                        <th>تاريخ التقرير</th>
                        {{-- <th> اسم المشرف</th> --}}
                        <th>الإضافة بواسطة</th>
                        {{-- <th>التعديل بواسطة</th> --}}
                        <th class="element-to-hide">العمليات</th>
                      </tr>
                    </thead>  
                    <tbody>
                      @foreach ($family->reports as $row)
                      <tr style='text-align:center;vertical-align:middle'>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->created_at->format('Y-m-d') }}</td>
                        <td>{{ $row->addedBy->name ? $row->addedBy->name . ' ' . $row->addedBy->family_name : 'لايوجد' }}</td>
                        {{-- <td>{{ $row->added_by ? $row->added_by : 'لايوجد' }}</td> --}}
                        <td class="element-to-hide">
                          {{-- @can('معاينة تقرير اليتيم') --}}
                          <a href="{{ route('admin.family-report.show',$row) }}" target="_blank" class="btn-lg rounded-pill waves-effect waves-light" title=" معاينة "><i class="fa fa-eye"></i> </a>
                          {{-- @endcan --}}
                          {{-- @can('تعديل تقرير اليتيم') --}}
                          <a href="{{ route('admin.family-report.edit',$row) }}" target="_blank" class="btn-lg rounded-pill waves-effect waves-light" title=" تعديل "><i class="fa fa-edit"></i> </a>
                          {{-- @endcan --}}
                          {{-- @can('حذف تقرير ') --}}
                          <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#reportInformation{{$row->id}}" class="btn-lg rounded-pill waves-effect waves-light" title=" حذف "><i class="fa fa-trash"></i> </a>
                          {{-- @endcan --}}
                        </td>
                      </tr>
                      <div class="modal fade" class="element-to-hide" id="reportInformation{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ 'حذف تقرير الأسرة ' }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.family-report.destroy', $row ) }}" method="post">
                                @csrf
                                @method('DELETE')
                                {{'هل أنت متأكد من حذف تقرير الأسرة ؟' }}
                                <input type="hidden" name="id" value="{{ $row->id  }}">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{'اغلاق'}}</button>
                              <button class="btn btn-success">{{'موافق'}}</button>
                            </div>
                            </form>
                          </div>
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
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
  function printDiv() {
      var printContents = document.getElementById('print').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      // location.reload();
  }
</script>

<script type="text/javascript">
  function printDiv2() {
      var printContents = document.getElementById('print2').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      // location.reload();
  }
</script>
@endpush