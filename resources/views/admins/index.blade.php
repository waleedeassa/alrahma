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
    border-radius: 15px;
    transition: all 0.35s ease;
    background: #ffffff;
    overflow: hidden;
    position: relative;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }

  .card-statistics:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(41, 96, 96, 0.15);
  }

  .stop-hover:hover {
    transform: none !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
  }

  .icon-box {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #296060;
    border-radius: 12px;
    color: white;
    font-size: 20px;
  }

  .counter h6 {
    font-size: 14px;
    color: #666;
    font-weight: 600;
    margin: 0;
  }

  .timer {
    font-weight: 700;
    font-size: 22px;
    color: #296060;
    margin: 0;
    line-height: 1.2;
  }

  .kpi-card {
    border-radius: 12px;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100%;
    transition: transform 0.2s;
  }

  .kpi-card:hover {
    transform: scale(1.02);
  }

  .kpi-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
  }

  .kpi-info {
    text-align: right;
  }

  .kpi-title {
    font-size: 13px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
  }

  .kpi-value {
    font-size: 20px;
    font-weight: 800;
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

<div class="row home-statistics">
  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.users.index') }}">
    <div class="card card-statistics h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box">
          <i class="fa fa-users" style="font-size: 25px;"></i>
        </div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">المستخدمين</h6>
          <h6 class="timer" data-to="{{ $usersCount }}" data-speed="500" style="font-size: 25px;">{{ $usersCount }}</h6>
        </div>
      </div>
    </div>
  </a>

  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.sponsors.index') }}">
    <div class="card card-statistics h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box">
          <i class="fa fa-handshake-o" style="font-size: 25px;"></i>
        </div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">الكفلاء</h6>
          <h6 class="timer" data-to="{{ $sponsorsCount }}" data-speed="500" style="font-size: 25px;">{{ $sponsorsCount }}</h6>
        </div>
      </div>
    </div>
  </a>

  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.governorates.index') }}">
    <div class="card card-statistics h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box">
          <i class="fa fa-map" style="font-size: 25px;"></i>
        </div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">الأقاليم</h6>
          <h6 class="timer" data-to="{{ $governoratesCount }}" data-speed="500" style="font-size: 25px;">{{ $governoratesCount }}</h6>
        </div>
      </div>
    </div>
  </a>

  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.cities.index') }}">
    <div class="card card-statistics h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box">
          <i class="fa fa-building" style="font-size: 25px;"></i>
        </div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">المدن / الجماعات</h6>
          <h6 class="timer" data-to="{{ $citiesCount }}" data-speed="500" style="font-size: 25px;">{{ $citiesCount }}</h6>
        </div>
      </div>
    </div>
  </a>

  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.families.index') }}">
    <div class="card card-statistics h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box">
          <i class="fa fa-home" style="font-size: 25px;"></i>
        </div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">أسر الأيتام</h6>
          <h6 class="timer" data-to="{{ $familiesCount }}" data-speed="500" style="font-size: 25px;">{{ $familiesCount }}</h6>
        </div>
      </div>
    </div>
  </a>

  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.difficult-case-families.index') }}">
    <div class="card card-statistics h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box">
          <i class="fa fa-exclamation-triangle" style="font-size: 25px;"></i>
        </div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">أسر فى وضعية صعبة</h6>
          <h6 class="timer" data-to="{{ $difficultCaseFamiliesCount }}" data-speed="500" style="font-size: 25px;">{{ $difficultCaseFamiliesCount }}</h6>
        </div>
      </div>
    </div>
  </a>

  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.special-needs-people.index') }}">
    <div class="card card-statistics h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box">
          <i class="fa fa-wheelchair" style="font-size: 25px;"></i>
        </div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">المرضى وذوي الاحتياجات</h6>
          <h6 class="timer" data-to="{{ $specialNeedsPeopleCount }}" data-speed="500" style="font-size: 25px;">{{ $specialNeedsPeopleCount }}</h6>
        </div>
      </div>
    </div>
  </a>

  <a class="col-xl-3 col-lg-6 col-md-6 mb-30 d-block" href="{{ route('admin.orphans.index') }}">
    <div class="card card-statistics h-100">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="icon-box">
          <i class="fa fa-child" style="font-size: 25px;"></i>
        </div>
        <div class="text-end counter">
          <h6 class="card-text text-dark" style="font-weight: bold; font-size: 17px;">الأيتام</h6>
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
        <div class="row g-3 mb-4">
          {{-- 1. Total Orphans --}}
          <div class="col-12 col-md-4">
            <div class="kpi-card" style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
              <div class="kpi-info">
                <div class="kpi-title">إجمالي الأيتام</div>
                <div class="kpi-value text-dark">{{ $orphansTotal }}</div>
              </div>
              <div class="kpi-icon text-dark bg-white shadow-sm">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
          {{-- 2. Sponsored --}}
          <div class="col-12 col-md-4">
            <div class="kpi-card" style="background-color: #d1e7dd; border: 1px solid #badbcc;">
              <div class="kpi-info">
                <div class="kpi-title" style="color: #0f5132;">المكفولين</div>
                <div class="kpi-value" style="color: #0f5132;">{{ $sponsoredCount }}</div>
              </div>
              <div class="kpi-icon shadow-sm" style="background-color: #0f5132; color: white;">
                <i class="fa fa-check"></i>
              </div>
            </div>
          </div>
          {{-- 3. Unsponsored --}}
          <div class="col-12 col-md-4">
            <div class="kpi-card" style="background-color: #f8d7da; border: 1px solid #f5c2c7;">
              <div class="kpi-info">
                <div class="kpi-title" style="color: #842029;">بانتظار كفالة</div>
                <div class="kpi-value" style="color: #842029;">{{ $notSponsoredCount }}</div>
              </div>
              <div class="kpi-icon shadow-sm" style="background-color: #842029; color: white;">
                <i class="fa fa-exclamation"></i>
              </div>
            </div>
          </div>
        </div>

        <hr class="mb-4">
        <div class="row g-3">
          <div class="col-12 mb-3">
            <div class="d-flex justify-content-between mb-1">
              <span class="text-dark fw-bold" style="font-size: 13px;">نسبة تغطية الكفالة</span>
              <span class="text-success fw-bold">{{ $sponsorshipRate }}%</span>
            </div>
            <div class="progress" style="height: 10px; border-radius: 5px; background-color: #e9ecef;">
              <div class="progress-bar bg-success" role="progressbar" style="width: {{ $sponsorshipRate }}%"></div>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="d-flex justify-content-between mb-1">
              <span class="text-dark fw-bold" style="font-size: 13px;">نسبة الاحتياج (غير مكفولين)</span>
              <span class="text-danger fw-bold">{{ $needRate }}%</span>
            </div>
            <div class="progress" style="height: 10px; border-radius: 5px; background-color: #e9ecef;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $needRate }}%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-6">
    <div class="card card-statistics h-100 stop-hover">
      <div class="card-header" style="background-color: #296060;color: white; border-radius: 10px 10px 0 0;">
        <h5 style="font-family: 'Cairo', sans-serif; text-align: center; margin: 0;"><strong>الفئات العمرية للأيتام</strong> </h5>
      </div>
      <div class="card-body d-flex justify-content-center align-items-center">
        <div style="width: 100%; height: 300px;">
          <canvas id="ageChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-6 mb-20">
    <div class="card card-statistics h-100 stop-hover">
      <div class="card-header" style="background-color: #296060;color: white; border-radius: 10px 10px 0 0;">
        <h5 style="font-family: 'Cairo', sans-serif; text-align: center; margin: 0;"><strong>اجراءات سريعة</strong> </h5>
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
                <div class="col-12 p-0 text-center" style="color: #296060;"><strong> اضافة حالة مرضى وذوى احتياج خاص</strong></div>
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
                <div class="col-12 p-0 text-center" style="color: #296060;"><strong>نسخة احتياطية</strong></div>
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
    </div>
  </div>
  <div class="col-xl-6 mb-20">
    <div class="card h-100 shadow-sm border-0 stop-hover">
      <div class="card-header text-white" style="background-color: #296060; border-radius: 10px 10px 0 0;">
        <h5 style="font-family: 'Cairo', sans-serif; text-align: center; margin: 0;">
          <strong>توزيع الأيتام حسب الجنس</strong>
        </h5>
      </div>
      <div class="card-body d-flex flex-column justify-content-center align-items-center">
        <div style="width: 100%; height: 300px; position: relative;">
          <canvas id="genderChart"></canvas>
        </div>
        <div class="mt-4 text-center">
          <span class="badge rounded-pill me-2 p-2" style="background-color: #296060; font-size: 14px;">
            الذكور : {{ $malesCount }}
          </span>
          <span class="badge rounded-pill p-2" style="background-color: #ffb703; color: #000; font-size: 14px;">
            الإناث : {{ $femalesCount }}
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">

  {{-- الأيتام حسب المحافظة --}}
  <div class="col-12">
    <div class="card shadow-sm border-0">
      <div class="card-header text-white" style="background-color:#296060;">
        <h6 class="text-center m-0"><strong>عدد الأيتام حسب المحافظة</strong></h6>
      </div>
      <div class="card-body">
        <div style="height:350px;">
          <canvas id="orphansGovChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  {{-- الأسر حسب المحافظة --}}
  <div class="col-12">
    <div class="card shadow-sm border-0">
      <div class="card-header text-white" style="background-color:#296060;">
        <h6 class="text-center m-0"><strong>عدد الأسر حسب المحافظة</strong></h6>
      </div>
      <div class="card-body">
        <div style="height:350px;">
          <canvas id="familiesGovChart"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@push('js')
<script src="{{ URL::asset('dashboard/assets/js/chart2.js')}}"></script>
<script>
  // 1. Gender Chart
    const ctxGender = document.getElementById('genderChart').getContext('2d');
    new Chart(ctxGender, {
        type: 'doughnut',
        data: {
            labels: ['ذكور', 'إناث'],
            datasets: [{
                data: [{{ $malesCount ?? 0 }}, {{ $femalesCount ?? 0 }}],
                backgroundColor: ['#296060', '#ffb703'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '50%',
            plugins: {
                legend: { position: 'bottom', labels: { font: { family: 'Cairo', size: 14 }, usePointStyle: true } }
            }
        }
    });

  // 2. Age Chart
    const ctxAge = document.getElementById('ageChart').getContext('2d');
    const ageData = [
        {{ $ageGroups['0-5'] ?? 0 }}, 
        {{ $ageGroups['6-12'] ?? 0 }}, 
        {{ $ageGroups['13-18'] ?? 0 }}, 
        {{ $ageGroups['+18'] ?? 0 }}
    ];

    new Chart(ctxAge, {
        type: 'bar',
        data: {
            labels: ['0-5 سنوات', '6-12 سنة', '13-18 سنة', '+18 سنة'],
            datasets: [{
                label: 'عدد الأيتام',
                data: ageData,
                backgroundColor: '#296060',
                borderRadius: 4,
                barThickness: 25,
                maxBarThickness: 25,
                // ===================================
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 ,
                        font: {size: 14,family: 'Cairo',weight: 'bold'}
                    },
                    grid: { borderDash: [2, 2] }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        font: {size: 14,family: 'Cairo',weight: 'bold'}
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });



new Chart(document.getElementById('orphansGovChart'), {
    type: 'bar',
    data: {
        labels: @json($govLabels),
        datasets: [{
            label: 'عدد الأيتام',
            data: @json($orphansGovCounts),
            backgroundColor: '#296060',
            borderRadius: 4,
            barThickness: 25,
            maxBarThickness: 25,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: {
                ticks: {
                font: {size: 14,family: 'Cairo',weight: 'bold'}
              } 
          },
          y: { beginAtZero: true,
                ticks: {
                font: {size: 14,family: 'Cairo',weight: 'bold'}
              }
           }
        }
    }
});


// الأسر
new Chart(document.getElementById('familiesGovChart'), {
    type: 'bar',
    data: {
        labels: @json($govLabels),
        datasets: [{
            label: 'عدد الأسر',
            data: @json($familiesGovCounts),
            backgroundColor: '#296060',
            borderRadius: 4,
            barThickness: 25,
            maxBarThickness: 25,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: {
                ticks: {
                font: {size: 14,family: 'Cairo',weight: 'bold'}
              } 
          },
          y: { beginAtZero: true,
                ticks: {
                font: {size: 14,family: 'Cairo',weight: 'bold'}
              }
          }
        }
    }
});
</script>
@endpush