@extends('layouts.master')
@section('title', "تفاصيل اليتيم")
@section('breadcrumpTitle', "تفاصيل اليتيم")
@section("breadcrump")
@parent
<li class="breadcrumb-item "><a href="{{ route('admin.orphans.index') }}" class="default-color">الأيتام</a></li>
<li class="breadcrumb-item active">تفاصيل اليتيم</li>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/orphans-family-form.css') }}" />

<style>

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
  @media print {

    #print_Button,
    .breadcrumb,
    .nav-tabs,
    .main-header,
    .footer {
      display: none !important;
    }

    header .container {
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    header .page-name {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .card-body {
      padding: 0;
    }

    /* إخفاء الأزرار والروابط عند الطباعة */
    a,
    button {
      display: none !important;
    }
  }

  /* تنسيق الصورة الشخصية في الهيدر */
  .orphan-header-img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 1px solid #ccc;
    padding: 2px;
    border-radius: 5px;
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
            <a class="nav-link active show" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">معلومات اليتيم</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="attachments-tab" data-bs-toggle="tab" href="#attachments" role="tab" aria-controls="attachments" aria-selected="false">المرفقات</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" id="reports-tab" data-bs-toggle="tab" href="#reports" role="tab" aria-controls="reports" aria-selected="false">التقارير الدوريه</a>
          </li> --}}
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
                    <h6>مؤسسة الرحمة للتنمية الاجتماعية</h6>
                    <h6>قسم الأيتام</h6>
                  </div>
                  <div class="page-name">
                    <h3>بطاقة معلومات اليتيم</h3>
                  </div>
                  <div class="orphan-image">
                    @if($orphan->image)
                    <img src="{{ Storage::disk('uploads')->url($orphan->image) }}" class="orphan-header-img" alt="صورة اليتيم" width="100%;height=100%">
                    @else
                    <img src="{{ asset('dashboard/assets/images/no_image.jpg') }}" class="orphan-header-img" alt="لا توجد صورة">
                    @endif
                  </div>
                </div>
              </header>
              <div class="main">
                <div class="container">
                  <div class="orphan-data">
                    <h5> البيانات الشخصية : Données Personnelles</h5>
                    <div class="line">
                      <label>الاسم الشخصي (AR)</label>
                      <input type="text" value="{{ $orphan->name_ar }}" readonly>
                      <label>الاسم الشخصي (FR)</label>
                      <input type="text" value="{{ $orphan->name_fr }}" readonly>
                    </div>
                    <div class="line">
                      <label>الاسم العائلي (AR)</label>
                      <input type="text" value="{{ $orphan->family_name_ar }}" readonly>
                      <label>الاسم العائلي (FR)</label>
                      <input type="text" value="{{ $orphan->family_name_fr }}" readonly>
                    </div>
                    <div class="line">
                      <label>تاريخ الازدياد</label>
                      <input type="text" value="{{ $orphan->birth_date }}" readonly>
                      <label>العمر الحالي</label>
                      <input type="text" value="{{ \Carbon\Carbon::parse($orphan->birth_date)->age }} سنة" readonly>
                      <label>الجنس</label>
                      <input type="text" value="{{ config('options.gender.'.$orphan->gender) ?? $orphan->gender }}" readonly>
                    </div>
                    <br>
                    <h5> الإقامة والعنوان : Résidence et Adresse</h5>
                    <div class="line">
                      <label>الإقليم</label>
                      <input type="text" value="{{ $orphan->governorate->name ?? '-' }}" readonly>
                      <label>المدينة / الجماعة</label>
                      <input type="text" value="{{ $orphan->city->name ?? '-' }}" readonly>
                      <label>المدينة (FR)</label>
                      <input type="text" value="{{ $orphan->city_in_french }}" readonly>
                    </div>
                    <div class="line">
                      <label>العنوان (AR)</label>
                      <input type="text" class="grow" value="{{ $orphan->address }}" readonly>
                    </div>
                    <div class="line">
                      <label>العنوان (FR)</label>
                      <input type="text" class="grow" value="{{ $orphan->address_in_french }}" readonly>
                    </div>
                    <br>
                    <h5> معلومات إضافية : Informations Complémentaires</h5>
                    <div class="line">
                      <label>رقم الهاتف</label>
                      <input type="text" value="{{ $orphan->phone }}" readonly>
                      <label>المشرف المسؤول</label>
                      <input type="text" value="{{ $orphan->supervisor->name ?? '-' }}" readonly>
                    </div>
                    <div class="line">
                      <label>الترتيب بين الإخوة</label>
                      <input type="text" value="{{ $orphan->arrangement_between_brothers }}" readonly>
                      <label>حالة الدخل</label>
                      <input type="text" value="{{ config('options.income_status.'.$orphan->income_status) ?? $orphan->income_status }}" readonly>
                      <label>دخل آخر</label>
                      <input type="text" value="{{ $orphan->other_income }}" readonly>
                    </div>
                    <br>
                    <h5> الصحة والقياسات : Santé et Mesures</h5>
                    <div class="line">
                      <label>الفصيلة الدموية</label>
                      <input type="text" value="{{ config('options.blood_type.'.$orphan->blood_type) ?? $orphan->blood_type }}" readonly>
                      <label>الحالة الصحية</label>
                      <input type="text" value="{{ config('options.health_status.'.$orphan->health_status) ?? $orphan->health_status }}" readonly>
                    </div>
                    <div class="line">
                      <label>قياس الحذاء</label>
                      <input type="text" value="{{ $orphan->shoe_size }}" readonly>
                      <label>قياس الملابس</label>
                      <input type="text" value="{{ $orphan->clothes_size }}" readonly>
                    </div>
                    <br>
                    <h5> التعليم : Éducation</h5>
                    <div class="line">
                      <label>المستوى الدراسي</label>
                      <input type="text" class="grow" value="{{ config('options.academic_level.'.$orphan->academic_level) ?? $orphan->academic_level }}" readonly>
                    </div>
                    @if($orphan->family)
                    <br>
                    <h5> مرجع الأسرة : Référence Familiale</h5>
                    <div class="line">
                      <label>رقم ملف الأسرة</label>
                      <input type="text" value="{{ $orphan->family->id }}" readonly>
                      <label>اسم الأم</label>
                      <input type="text" value="{{ $orphan->family->mother_name ?? '-' }}" readonly>
                    </div>
                    @endif
                    <br>
                    <h5> معلومات الكفالة : Informations de la Garantie</h5>
                    <div class="line">
                      <label>هل اليتيم مكفول</label>
                      <input type="text" value="{{ $orphan->sponsor_id != null ? 'نعم' : 'لا' }}" readonly>
                      <label> اسم الكفيل</label>
                      <input type="text" value="{{$orphan->sponsor_id != null ? $orphan->sponsor->name : '-' }}" readonly>
                    </div>
                    @if($orphan->cancellation_reason != null)
                    <div class="line">
                      <label>سبب الغاء الكفالة السابقة</label>
                      <input type="text" class="grow" value="{{ $orphan->cancellationReasonLabel }}" readonly>
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

                @if($orphan->attachments->count() > 0)
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
                      @foreach ($orphan->attachments as $attachment)
                      <tr style='text-align:center;vertical-align:middle'>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attachment->original_name }}</td>
                        <td>{{ $attachment->created_at->diffForHumans() }}</td>
                        <td>
                          {{-- عرض --}}
                          <a class="btn btn-dark btn-sm" href="{{ route('admin.view_orphan_attachment', $attachment) }}" target="_blank" role="button">
                            <i class="fa fa-eye"></i> {{ 'عرض' }}
                          </a>

                          {{-- تحميل --}}
                          <a class="btn btn-success btn-sm" href="{{ route('admin.download_orphan_attachment', $attachment) }}" role="button">
                            <i class="fa fa-cloud-download"></i> {{ 'تحميل' }}
                          </a>

                          {{-- حذف --}}
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete_img{{ $attachment->id }}" title="حذف">
                            <i class="fa fa-trash"></i> {{'حذف'}}
                          </button>
                        </td>
                      </tr>
                      {{-- Modal Delete --}}
                      <div class="modal fade" id="Delete_img{{ $attachment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.delete_orphan_attachment', $attachment) }}" method="post">
                                @csrf
                                {{'هل أنت متأكد من حذف المرفق ؟' }}
                                <input type="hidden" name="id" value="{{ $attachment->id }}">
                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{'اغلاق'}}</button>
                              <button class="btn btn-success">{{'موافق'}}</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      {{-- End Modal --}}

                      @endforeach
                    </tbody>
                  </table>
                </div>
                @else
                <div class="alert alert-info text-center mt-3">لا توجد مرفقات لهذا اليتيم حالياً.</div>
                @endif
              </div>
            </div>
          </div>
          {{-- reports tab --}}

          <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="report-tab">
            {{-- @can('إضافة تقرير أسرة') --}}
            <a class="button black x-small" href="{{ route('admin.orphan-report.create',$orphan) }}" target="_blank"> <i class="fa fa-plus"></i>{{' اضافة تقرير دورى' }}</a>
            {{-- @endcan --}}
            <div class="form-group mb-3 col-md-12">
              <div class="card-body">
                <div class="table-responsive" id="print5">
                  <table class="table">
                    <thead>
                      <tr class="table-head">
                        <th>#</th>
                        <th>تاريخ التقرير</th>
                        <th>الإضافة بواسطة</th>
                        <th class="element-to-hide">العمليات</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($orphan->reports as $row)
                      <tr style='text-align:center;vertical-align:middle'>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->created_at->format('Y-m-d') }}</td>
                        <td>{{ $row->added_by ? $row->addedBy->name . ' ' . $row->addedBy->family_name : 'لايوجد' }}</td>
                        <td class="element-to-hide">
                          {{-- @can('معاينة تقرير اليتيم') --}}
                          <a href="{{ route('admin.orphan-report.show',$row) }}" target="_blank" class="btn-lg rounded-pill waves-effect waves-light" title=" معاينة "><i class="fa fa-eye"></i> </a>
                          {{-- @endcan --}}
                          {{-- @can('تعديل تقرير اليتيم') --}}
                          <a href="{{ route('admin.orphan-report.edit',$row) }}" target="_blank" class="btn-lg rounded-pill waves-effect waves-light" title=" تعديل "><i class="fa fa-edit"></i> </a>
                          {{-- @endcan --}}
                          {{-- @can('حذف تقرير اليتيم') --}}
                          <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#reportInformation{{$row->id}}" class="btn-lg rounded-pill waves-effect waves-light" title=" حذف "><i class="fa fa-trash"></i> </a>
                          {{-- @endcan --}}
                        </td>
                      </tr>
                      <div class="modal fade" class="element-to-hide" id="reportInformation{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                {{ 'حذف تقرير اليتيم ' }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('admin.orphan-report.destroy', $row ) }}" method="post">
                                @csrf
                                @method('DELETE')
                                {{'هل أنت متأكد من حذف تقرير اليتيم ؟' }}
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
  }
</script>
@endpush