<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <!-- logo -->
  <div class="text-center navbar-brand-wrapper">
    
    <span style="text-align: center; color: #fff; font-size: 19px; font-weight: bold">مؤسسة الرحمة </span>
  </div>
  <!-- Top bar left -->
  <ul class="nav navbar-nav me-auto">
    <li class="nav-item">
      <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
    </li>
  </ul>
  <!-- top bar right -->
  <ul class="nav navbar-nav ms-auto">
    {{-- <li class="nav-item dropdown" >
      <a class="nav-link top-nav" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="badge badge-danger navbar-badge" style="top: -15px; position: relative; color: white; margin-right: 5px; font-size: 13px">
          {{ $unreadNotificationsCount }}
        </span>
        <i class="ti-bell"></i> 
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
        <div class="dropdown-divider"></div>
        @foreach (Auth::user()->notifications->take(5) as $notification)
        <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}" class="dropdown-item @if($notification->unread()) fw-bold @endif">
          <i class="{{ $notification->data['icon'] }}"></i>
          {{ $notification->data['body'] }}
          <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
        </a>
        @endforeach
      </div>
    </li> --}}

    <li class="nav-item ">
      <div style="cursor: pointer">
        {{ now()->format('d-m-Y') }}
      </div>
    </li>
    <li class="nav-item dropdown mr-30">
      <a class="nav-link nav-pill user-avatar" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        @if (Auth::guard('web')->check())
        <img src="{{ Auth::user()->photo_url }} " alt="avatar">
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header">
          @if (Auth::guard('web')->check())
          <h6 class="mt-0 mb-0">
            {{ Auth::guard('web')->user()->name }}
          </h6>
          <span>
            {{ Auth::guard('web')->user()->email }}
          </span>
          @endif
        </div>
        <div class="dropdown-divider"></div>

        @if(Auth::guard('web')->check())
        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="text-warning ti-user"></i>الملف الشخصى</a>
        <a class="dropdown-item" href="{{ route('admin.password') }}"><i class="text-dark ti-layers-alt"></i>تغيير كلمة المرور </a>
        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item"> <i class="text-danger ti-unlock"></i>تسجيل الخروج</a>
        <form action="{{ route('admin.logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
        @endif
      </div>
    </li>
  </ul>
</nav>