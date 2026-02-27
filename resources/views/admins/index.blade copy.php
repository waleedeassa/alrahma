@extends('layouts.master')
@section('title','لوحة التحكم ')
@section('breadcrump','')
@push('css')
<style>
  .home-statistics a {
    text-decoration: none;
  }

  .card-statistics {
    border: none;
    border-radius: 18px;
    transition: all 0.35s ease;
    background: #ffffff;
    overflow: hidden;
    position: relative;
  }

  /* الحركة للكروت العادية فقط */
  .card-statistics:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(41, 96, 96, 0.15);
  }

  /* كلاس جديد لمنع الحركة للكروت الثابتة */
  .stop-hover:hover {
    transform: none !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
  }

  .icon-box {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #296060;
    border-radius: 50%;
    color: white;
  }

  .highlight-icon {
    font-size: 22px;
  }

  .counter h6 {
    font-size: 18px;
    color: #444;
    font-weight: 600;
    margin: 0;
  }

  .timer {
    font-weight: normal;
    font-size: 25px;
    color: #296060;
    margin: 0;
  }
</style>
@endpush
@section('content')
<div class="row mb-4">
  <div class="col-12">
    <div class="alert alert-light border-0 shadow-sm d-flex align-items-center" role="alert" style="background: white; border-left: 5px solid #296060 !important;">
      <div class="me-3">
        <h4 class="alert-heading mb-0" style="font-family: 'Cairo'; color: #296060;">
          {{ "مرحبا بعودتك" }}, {{ auth()->user()->name }} 👋
        </h4>
        <p class="mb-0 mt-1 text-muted">يوم عمل موفق !</p>
      </div>
    </div>
  </div>
</div>

{{-- البطاقات الإحصائية العلوية --}}
<div class="row home-statistics">
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.users.index') }}">
    <div class="card card-statistics h-100 hover-shadow">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box"><i class="fa fa-users highlight-icon"></i></div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold;">المستخدمين</h6>
          <h6 class="timer" data-to="{{ $usersCount }}" data-speed="500" style="font-size: 25px;">{{ $usersCount }}</h6>
        </div>
      </div>
    </div>
  </a>
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.sponsors.index') }}">
    <div class="card card-statistics h-100 hover-shadow">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box"><i class="fa fa-handshake-o highlight-icon"></i></div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold;">الكفلاء</h6>
          <h6 class="timer" data-to="{{ $sponsorsCount }}" data-speed="500" style="font-size: 25px;">{{ $sponsorsCount }}</h6>
        </div>
      </div>
    </div>
  </a>
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.governorates.index') }}">
    <div class="card card-statistics h-100 hover-shadow">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box"><i class="fa fa-map highlight-icon"></i></div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold;">الأقاليم</h6>
          <h6 class="timer" data-to="{{ $governoratesCount }}" data-speed="500" style="font-size: 25px;">{{ $governoratesCount }}</h6>
        </div>
      </div>
    </div>
  </a>
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.cities.index') }}">
    <div class="card card-statistics h-100 hover-shadow">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box"><i class="fa fa-building highlight-icon"></i></div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold;">المدن / الجماعات</h6>
          <h6 class="timer" data-to="{{ $citiesCount }}" data-speed="500" style="font-size: 25px;">{{ $citiesCount }}</h6>
        </div>
      </div>
    </div>
  </a>
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.families.index') }}">
    <div class="card card-statistics h-100 hover-shadow">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box"><i class="fa fa-home highlight-icon"></i></div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold;">الأسر</h6>
          <h6 class="timer" data-to="{{ $familiesCount }}" data-speed="500" style="font-size: 25px;">{{ $familiesCount }}</h6>
        </div>
      </div>
    </div>
  </a>
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.difficult-case-families.index') }}">
    <div class="card card-statistics h-100 hover-shadow">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box"><i class="fa fa-exclamation-triangle highlight-icon"></i></div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold;">الأسر فى وضعية صعبة</h6>
          <h6 class="timer" data-to="{{ $difficultCaseFamiliesCount }}" data-speed="500" style="font-size: 25px;">{{ $difficultCaseFamiliesCount }}</h6>
        </div>
      </div>
    </div>
  </a>
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.special-needs-people.index') }}">
    <div class="card card-statistics h-100 hover-shadow">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box"><i class="fa fa-wheelchair highlight-icon"></i></div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold;">المرضى وذوى الاحتياجات</h6>
          <h6 class="timer" data-to="{{ $specialNeedsPeopleCount }}" data-speed="500" style="font-size: 25px;">{{ $specialNeedsPeopleCount }}</h6>
        </div>
      </div>
    </div>
  </a>
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.orphans.index') }}">
    <div class="card card-statistics h-100 hover-shadow">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box"><i class="fa fa-child highlight-icon"></i></div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold;">الأيتام</h6>
          <h6 class="timer" data-to="{{ $orphans }}" data-speed="500" style="font-size: 25px;">{{ $orphans }}</h6>
        </div>
      </div>
    </div>
  </a>
</div>

<div class="row g-3 mb-4">
  {{-- Right section: Sponsorship KPIs --}}
  <div class="col-12 col-lg-6">
    <div class="card h-100 shadow-sm border-0 stop-hover">
      <div class="card-header text-white" style="background-color: #296060; border-radius: 10px 10px 0 0;">
        <h5 style="font-family: 'Cairo', sans-serif; text-align: center; margin: 0;">
          <strong>ملخص الكفالة والاحتياج</strong>
        </h5>
      </div>
      <div class="card-body">
        <div class="row g-3 mb-4 text-center">
          {{-- Card 1: Total Orphans --}}
          <div class="col-12 col-md-4">
            <div class="card card-sm hover-shadow h-100 border-0" style="background-color: #f0fdf4;">
              <div class="card-body py-3">
                <div class="d-flex justify-content-center align-items-center mb-2">
                  <h6 class="text-secondary mb-0" style="font-size: 13px;">إجمالي الأيتام</h6>
                </div>
                <h5 class="text-success fw-bold mb-0">
                  {{ $orphansTotal }} <small class="fw-normal" style="font-size: 10px;">يتيم</small>
                </h5>
              </div>
            </div>
          </div>

          {{-- Card 2: Sponsored (تمت إعادة علامة الصح) --}}
          <div class="col-12 col-md-4">
            <div class="card card-sm hover-shadow h-100 border-0" style="background-color: #eff6ff;">
              <div class="card-body py-3">
                <div class="d-flex justify-content-center align-items-center mb-2">
                  <h6 class="text-secondary mb-0 me-2" style="font-size: 13px;">المكفولين</h6>
                  <span class="badge bg-white text-primary shadow-sm" style="font-size: 11px; border-radius: 10px;">
                    <i class="fa fa-check"></i>
                  </span>
                </div>
                <h5 class="text-primary fw-bold mb-0">
                  {{ $sponsoredCount }} <small class="fw-normal" style="font-size: 10px;">يتيم</small>
                </h5>
              </div>
            </div>
          </div>

          {{-- Card 3: Not Sponsored (تمت إعادة علامة التعجب) --}}
          <div class="col-12 col-md-4">
            <div class="card card-sm hover-shadow h-100 border-0" style="background-color: #fff1f2;">
              <div class="card-body py-3">
                <div class="d-flex justify-content-center align-items-center mb-2">
                  <h6 class="text-secondary mb-0 me-2" style="font-size: 13px;">بانتظار كفالة</h6>
                  <span class="badge bg-white shadow-sm" style="color: #e11d48; font-size: 11px; border-radius: 10px;">
                    !
                  </span>
                </div>
                <h5 class="fw-bold mb-0" style="color: #e11d48 !important;">
                  {{ $notSponsoredCount }} <small class="fw-normal" style="font-size: 10px;">يتيم</small>
                </h5>
              </div>
            </div>
          </div>
        </div>

        <hr class="mb-4">

        <div class="row g-3">
          <div class="col-12 mb-3">
            @php $sponsorshipRate = $orphansTotal > 0 ? ($sponsoredCount / $orphansTotal) * 100 : 0; @endphp
            <div class="d-flex justify-content-between mb-1">
              <span class="text-dark fw-bold" style="font-size: 13px;">نسبة تغطية الكفالة</span>
              <span class="text-success fw-bold">{{ number_format($sponsorshipRate, 1) }}%</span>
            </div>
            <div class="progress" style="height: 10px; border-radius: 5px; background-color: #e9ecef;">
              <div class="progress-bar bg-success" role="progressbar" style="width: {{ $sponsorshipRate }}%"></div>
            </div>
          </div>
          <div class="col-12 mb-3">
            @php $needRate = $orphansTotal > 0 ? ($notSponsoredCount / $orphansTotal) * 100 : 0; @endphp
            <div class="d-flex justify-content-between mb-1">
              <span class="text-dark fw-bold" style="font-size: 13px;">نسبة الاحتياج (غير مكفولين)</span>
              <span class="text-danger fw-bold">{{ number_format($needRate, 1) }}%</span>
            </div>
            <div class="progress" style="height: 10px; border-radius: 5px; background-color: #e9ecef;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $needRate }}%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Left section: Gender Chart --}}
  <div class="col-12 col-lg-6">
    <div class="card h-100 shadow-sm border-0 stop-hover">
      <div class="card-header text-white" style="background-color: #296060; border-radius: 10px 10px 0 0;">
        <h5 style="font-family: 'Cairo', sans-serif; text-align: center; margin: 0;">
          <strong>توزيع الأيتام حسب الجنس</strong>
        </h5>
      </div>
      <div class="card-body d-flex flex-column justify-content-center align-items-center">
        <!-- تم الحفاظ على الحجم الكبير للدائرة -->
        <div style="width: 100%; height: 300px; position: relative;">
          <canvas id="genderChart"></canvas>
        </div>
        <div class="mt-4 text-center">
          <span class="badge rounded-pill me-2 p-2" style="background-color: #296060; font-size: 14px;">
            الذكور: {{ $malesCount }}
          </span>
          <span class="badge rounded-pill p-2" style="background-color: #ffb703; color: #000; font-size: 14px;">
            الإناث: {{ $femalesCount }}
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-6 mb-20">
    {{-- تم الحفاظ على إيقاف الحركة --}}
    <div class="card card-statistics h-100 stop-hover">
      <div class="card-header" style="background-color: #296060;color: white;">
        <h5 style="font-family: 'Cairo', sans-serif; text-align: center;"><strong>اجراءات سريعه</strong> </h5>
      </div>
      <div class="card-body">
        <div class="col-12 p-3 row d-flex">
          <div class="col-6 col-md-4 col-lg-4 d-flex justify-content-center align-items-center mb-3 py-2">
            <a href="{{ route('admin.families.create') }}" style="color:inherit;">
              <div class="col-12 p-0 text-center">
                <img src="{{asset('dashboard/assets/images/icons/family.png')}}" style="width:50px;height: 50px">
                <div class="col-12 p-0 text-center" style="color: #296060;"><strong>اضافة أسرة يتيم</strong></div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-4  d-flex justify-content-center align-items-center mb-3 py-2">
            <a href="{{ route('admin.difficult-case-families.create') }}" style="color:inherit;">
              <div class="col-12 p-0 text-center">
                <img src="{{asset('dashboard/assets/images/icons/social-service.png')}}" style="width:50px;height: 50px">
                <div class="col-12 p-0 text-center" style="color: #296060;"><strong>اضافة أسرة فى وضعيه صعبة</strong></div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-4  d-flex justify-content-center align-items-center mb-3 py-2">
            <a href="{{ route('admin.special-needs-people.create') }}" style="color:inherit;">
              <div class="col-12 p-0 text-center">
                <img src="{{asset('dashboard/assets/images/icons/couple.png')}}" style="width:50px;height: 50px">
                <div class="col-12 p-0 text-center" style="color: #296060;"><strong>اضافة حالة مرضى وذوى احتاج خاص </strong></div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-4  d-flex justify-content-center align-items-center mb-3 py-2">
            <a href="{{ route('admin.support-programs.index') }}" style="color:inherit;">
              <div class="col-12 p-0 text-center">
                <img src="{{asset('dashboard/assets/images/icons/social-services.png')}}" style="width:50px;height: 50px">
                <div class="col-12 p-0 text-center" style="color: #296060;"><strong>اضافة برنامج دعم</strong></div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-4  d-flex justify-content-center align-items-center mb-3 py-2">
            <a href="{{ route('admin.backups.create') }}" style="color:inherit;">
              <div class="col-12 p-0 text-center">
                <img src="{{asset('dashboard/assets/images/icons/database.png')}}" style="width:50px;height: 50px">
                <div class="col-12 p-0 text-center" style="color: #296060;"><strong>اضافة نسخة احتياطية</strong></div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-4 d-flex justify-content-center align-items-center mb-3 py-2">
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="color:inherit;">
              <div class="col-12 p-0 text-center">
                <img src="{{asset('dashboard/assets/images/icons/logout.png')}}" style="width:50px;height: 50px">
                <div class="col-12 p-0 text-center" style="color: #296060;"><strong>تسجيل الخروج</strong></div>
              </div>
            </a>
            <form action="{{ route('admin.logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
          </div>
        </div>
      </div>
      <div id="sparkline2" class="scrollbar-x text-center"></div>
    </div>
  </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('genderChart').getContext('2d');
    
    const genderChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['ذكور', 'إناث'],
            datasets: [{
                data: [{{ $malesCount }}, {{ $femalesCount }}],
                backgroundColor: [
                    '#296060',
                    '#ffb703'
                ],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '50%', // تم الحفاظ على سمك الدائرة
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: 'Cairo', size: 14 },
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>
@endpush