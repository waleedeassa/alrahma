<div class="side-menu-fixed">
  <div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
      <li class="{{ Route::is('sponsor.dashboard') ? 'active' : '' }}">
        <a href="{{ route('sponsor.dashboard') }}"><i class="ti-home"></i><span class="right-nav-text">لوحة التحكم</span> </a>
      </li>

      {{-- users --}}
      {{-- @can('users')
      <li class="{{ Route::is('dashboard.users.index') ? 'active' : '' }}">
        <a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span class="right-nav-text">المستخدمين</span></a>
      </li>
      @endcan --}}

      {{-- sign out --}}
      <li>
        <a href="{{ route('sponsor.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
          <div class="pull-left"><i class="fa fa-sign-out" style="font-size: 16px;"></i><span class="right-nav-text">تسجيل الخروج</span>
          </div>
          <div class="clearfix"></div>
        </a>
        <form action="{{ route('sponsor.logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
      </li>
    </ul>
  </div>
</div>