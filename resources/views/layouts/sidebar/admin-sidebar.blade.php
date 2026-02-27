<div class="side-menu-fixed">
  <div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
      <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}"><i class="ti-home" style="font-size: 17px;"></i><span class="right-nav-text">لوحة التحكم</span> </a>
      </li>
      {{-- users --}}
      {{-- @can('ادارة المستخدمين') --}}
      <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i><span class="right-nav-text">المستخدمين2</span></a>
      </li>
      {{-- @endcan --}}

      <!-- Roles & Permissions-->
      {{-- @can('المسؤولين والصلاحيات') --}}
      {{-- <li>
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#roles" aria-expanded="{{ Route::is('admin.roles.index') || Route::is('admin.permissions.index') || Route::is('admin.role-permissions.index') ? 'true' : 'false' }}"> 
          <div class="pull-left"><i class="fa fa-lock" style="font-size: 19px;"></i><span class="right-nav-text">المسؤولين والصلاحيات</span></div>
          <div class="pull-right"><i class="ti-plus"></i></div>
          <div class="clearfix"></div>
        </a>
        <ul id="roles" class="collapse {{ Route::is('admin.roles.index') || Route::is('admin.permissions.index') || Route::is('admin.role-permissions.index') ? 'show' : '' }}" data-bs-parent="#sidebarnav">
          @can('استعراض المسؤولين')
          <li> <a href="{{ route('admin.roles.index') }}">المسؤولين</a> </li>
          @endcan
          @can('استعراض الصلاحيات')
          <li> <a href="{{ route('admin.permissions.index') }}">الصلاحيات</a> </li>
           @endcan 
          @can('استعراض صلاحيات المسؤولين') 
          <li> <a href="{{ route('admin.role-permissions.index') }}">صلاحيات المسؤولين</a> </li>
          @endcan
        </ul>
      </li> --}}
      {{-- @endcan --}}
      {{-- @can('ادارة الكفلاء') --}}
      <li class="{{ Route::is('admin.sponsors.index') ? 'active' : '' }}">
        <a href="{{ route('admin.sponsors.index') }}"><i class="fa fa-handshake-o "  style="font-size: 17px;"></i><span class="right-nav-text">الكفلاء</span></a>
      </li>
      {{-- @endcan --}}
      {{-- @can('الأقاليم والمدن') --}}
      <li>
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#governorates" aria-expanded="{{ Route::is('admin.governorates.index') || Route::is('admin.cities.index') ? 'true' : 'false' }}">
          <div class="pull-left"><i class="fa fa-globe" style="font-size: 20px;"></i><span class="right-nav-text"> الأقاليم و المدن</span></div>
          <div class="pull-right"><i class="ti-plus"></i></div>
          <div class="clearfix"></div>
        </a>
        <ul id="governorates" class="collapse {{ Route::is('admin.governorates.index') || Route::is('admin.cities.index') ? 'show' : '' }}" data-parent="#sidebarnav">
          {{-- @can('استعراض الأقاليم') --}}
          <li> <a href="{{ route('admin.governorates.index') }}" style="font-size: 13px;"> الأقاليم</a> </li>
          {{-- @endcan --}}
          {{-- @can('استعراض المدن') --}}
          <li> <a href="{{ route('admin.cities.index') }}" style="font-size: 13px;"> المدن - الجماعات</a> </li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      <li>
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#families"
          aria-expanded="{{Route::is('admin.families.index')||Route::is('admin.difficult-case-families.index')||Route::is('admin.special-needs-people.index')?'true':'false'}}">
          <div class="pull-left"><i class="fa fa-home" style="font-size:19px;"></i><span class="right-nav-text">الفئات المستفيدة</span></div>
          <div class="pull-right"><i class="ti-plus"></i></div>
          <div class="clearfix"></div>
        </a>
        <ul id="families" class="collapse {{Route::is('admin.families.index')||Route::is('admin.difficult-case-families.index')||Route::is('admin.special-needs-people.index')?'show':''}}" data-parent="#sidebarnav">
          <li><a href="{{route('admin.families.index')}}" class="{{Route::is('admin.families.index')?'active':''}}" style="font-size:13px;">أسر الأيتام</a></li>
          <li><a href="{{route('admin.difficult-case-families.index')}}" class="{{Route::is('admin.difficult-case-families.index')?'active':''}}" style="font-size:13px;">الأسر في وضعية صعبة</a></li>
          <li><a href="{{route('admin.special-needs-people.index')}}" class="{{Route::is('admin.special-needs-people.index')?'active':''}}" style="font-size:13px;">المرضى وذوي الإحتياجات الخاصة</a></li>
        </ul>
      </li>

      <li>
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#support-programs" aria-expanded="{{Route::is('admin.support-programs.index') || Route::is('admin.difficult_case_support_programs.create') || Route::is('admin.support-programs.create') ?'true':'false'}}">
          <div class="pull-left"><i class="fa fa-briefcase" style="font-size:16px;"></i><span class="right-nav-text">برامج الدعم</span></div>
          <div class="pull-right"><i class="ti-plus"></i></div>
          <div class="clearfix"></div>
        </a>
        <ul id="support-programs" class="collapse {{Route::is('admin.support-programs.index') || Route::is('admin.difficult_case_support_programs.create') || Route::is('admin.special_needs_people_support_programs.create')?'show':''}}" data-parent="#sidebarnav">
          <li><a href="{{route('admin.support-programs.index')}}" class="{{Route::is('admin.support-programs.index')?'active':''}}" style="font-size:13px;">استعراض البرامج</a></li>
          <li><a href="{{route('admin.difficult_case_support_programs.create')}}" class="{{Route::is('admin.difficult_case_support_programs.create')?'active':''}}" style="font-size:13px;"> دعم الأسر في وضعية صعبة </a></li>
          <li><a href="{{route('admin.special_needs_people_support_programs.create')}}" class="{{Route::is('admin.special_needs_people_support_programs.create')?'active':''}}" style="font-size:13px;"> دعم المرضى وذوي الاحتياجات </a></li>
          {{-- <li><a href="{{route('admin.special-needs-people.index')}}" class="{{Route::is('admin.special-needs-people.index')?'active':''}}" style="font-size:13px;">المرضى وذوي الاحتياجات</a></li> --}}
        </ul>
      </li>
      {{-- @can('ادارة الأيتام') --}}
      <li class="{{ Route::is('admin.orphans.index') ? 'active' : '' }}">
        <a href="{{ route('admin.orphans.index') }}"><i class="fa fa-child " style="font-size: 20px;"></i><span class="right-nav-text">الأيتام</span></a>
      </li>
      {{-- @endcan --}}
      
      <li class="{{ Route::is('admin.assign-orphans-to-sponsor.index') ? 'active' : '' }}">
        <a href="{{ route('admin.assign-orphans-to-sponsor.index') }}"><i class="fa fa-envelope-o" style="font-size: 17px;"></i><span class="right-nav-text"> كفالة الأيتام</span></a>
      </li>

      <li>
        <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#families_search" aria-expanded="{{ Route::is('admin.families.search.index') || Route::is('admin.difficult-case-families.search.index') || Route::is('admin.special-needs-people.search.index') || Route::is('admin.difficult-case-support-programs.search.index') || Route::is('admin.special_needs_people_support_programs.search.index')  ? 'true' : 'false' }}">
          <div class="pull-left"><i class="fa fa-search" style="font-size: 20px;"></i><span class="right-nav-text">التقارير</span></div>
          <div class="pull-right"><i class="ti-plus"></i></div>
          <div class="clearfix"></div>
        </a>
        <ul id="families_search" class="collapse {{ Route::is('admin.families.search.index') || Route::is('admin.difficult-case-families.search.index') || Route::is('admin.special-needs-people.search.index') || Route::is('admin.difficult-case-support-programs.search.index') || Route::is('admin.special_needs_people_support_programs.search.index')   ? 'show' : '' }}" data-parent="#sidebarnav">
          <li> <a href="{{ route('admin.families.search.index') }}" style="font-size: 13px;"> أسر الأيتام</a></li>
          <li> <a href="{{ route('admin.difficult-case-families.search.index') }}" style="font-size: 13px;">الأسر في وضعية صعبة</a></li>
          <li> <a href="{{ route('admin.special-needs-people.search.index') }}" style="font-size: 13px;">المرضى وذوي الاحتياجات </a></li>
          <li> <a href="{{ route('admin.difficult-case-support-programs.search.index') }}" style="font-size: 13px;">دعم الأسر في وضعية صعبة</a></li>
          <li> <a href="{{ route('admin.special_needs_people_support_programs.search.index') }}" style="font-size: 13px;">دعم المرضى وذوي الاحتياجات</a></li>
        </ul>
      </li>

      <li class="{{ Route::is('admin.backups.index') ? 'active' : '' }}">
        <a href="{{ route('admin.backups.index') }}"><i class="fa fa-users"></i><span class="right-nav-text">النسخ الاحتياطي</span></a>
      </li>
      {{-- sign out --}}
      <li>
        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
          <div class="pull-left"><i class="fa fa-sign-out" style="font-size: 16px;"></i><span class="right-nav-text">تسجيل الخروج</span>
          </div>
          <div class="clearfix"></div>
        </a>
        <form action="{{ route('admin.logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
      </li>
    </ul>
  </div>
</div>