<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            @can('لوحة التحكم')
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="ti-home" style="font-size: 17px;"></i><span class="right-nav-text">لوحة التحكم</span> </a>
                </li>
            @endcan
            {{-- users --}}
            @can('إدارة المستخدمين')
                <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i><span class="right-nav-text">المستخدمين</span></a>
                </li>
            @endcan

            <!-- Roles & Permissions-->
            @can('إدارة المسؤولين والصلاحيات')
                <li>
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
                </li>
            @endcan
            @can('إدارة الكفلاء')
                <li class="{{ Route::is('admin.sponsors.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.sponsors.index') }}"><i class="fa fa-handshake-o " style="font-size: 17px;"></i><span class="right-nav-text">الكفلاء</span></a>
                </li>
            @endcan
            @can('إدارة الأقاليم والمدن')
                <li>
                    <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#governorates" aria-expanded="{{ Route::is('admin.governorates.index') || Route::is('admin.cities.index') ? 'true' : 'false' }}">
                        <div class="pull-left"><i class="fa fa-globe" style="font-size: 20px;"></i><span class="right-nav-text"> الأقاليم و المدن</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="governorates" class="collapse {{ Route::is('admin.governorates.index') || Route::is('admin.cities.index') ? 'show' : '' }}" data-parent="#sidebarnav">
                        @can('استعراض الأقاليم')
                            <li> <a href="{{ route('admin.governorates.index') }}" style="font-size: 13px;"> الأقاليم</a> </li>
                        @endcan
                        @can('استعراض المدن')
                            <li> <a href="{{ route('admin.cities.index') }}" style="font-size: 13px;"> المدن - الجماعات</a> </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('إدارة الفئات المستفيدة')
                <li>
                    <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#families" aria-expanded="{{ Route::is('admin.families.index') || Route::is('admin.difficult-case-families.index') || Route::is('admin.special-needs-people.index') ? 'true' : 'false' }}">
                        <div class="pull-left"><i class="fa fa-home" style="font-size:19px;"></i><span class="right-nav-text">الفئات المستفيدة</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="families" class="collapse {{ Route::is('admin.families.index') || Route::is('admin.difficult-case-families.index') || Route::is('admin.special-needs-people.index') ? 'show' : '' }}" data-parent="#sidebarnav">
                        @can('استعراض أسر الأيتام')
                            <li><a href="{{ route('admin.families.index') }}" class="{{ Route::is('admin.families.index') ? 'active' : '' }}" style="font-size:13px;">أسر الأيتام</a></li>
                        @endcan
                        @can('استعراض الأسر فى وضعية صعبة')
                            <li><a href="{{ route('admin.difficult-case-families.index') }}" class="{{ Route::is('admin.difficult-case-families.index') ? 'active' : '' }}" style="font-size:13px;">الأسر في وضعية صعبة</a></li>
                        @endcan
                        @can('استعراض المرضى وذوي الإحتياجات الخاصة')
                            <li><a href="{{ route('admin.special-needs-people.index') }}" class="{{ Route::is('admin.special-needs-people.index') ? 'active' : '' }}" style="font-size:13px;">المرضى وذوي الإحتياجات الخاصة</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('إدارة برامج الدعم')
                <li>
                    <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#support-programs" aria-expanded="{{ Route::is('admin.support-programs.index')  || Route::is('admin.support-program-entries.index') ? 'true' : 'false' }}">
                        <div class="pull-left"><i class="fa fa-briefcase" style="font-size:16px;"></i><span class="right-nav-text">برامج الدعم</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="support-programs" class="collapse {{ Route::is('admin.support-programs.index') || Route::is('admin.support-program-entries.index')  ? 'show' : '' }}" data-parent="#sidebarnav">
                        @can('استعراض برامج الدعم')
                            <li><a href="{{ route('admin.support-programs.index') }}" class="{{ Route::is('admin.support-programs.index') ? 'active' : '' }}" style="font-size:13px;">استعراض البرامج</a></li>
                        @endcan
                        @can('إدارة سجلات الاستفادة من برامج الدعم')
                        <li><a href="{{ route('admin.support-program-entries.index') }}" class="{{ Route::is('admin.support-program-entries.index') ? 'active' : '' }}" style="font-size:13px;">سجلات الاستفادة من البرامج </a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('إدارة الأيتام')
                <li class="{{ Route::is('admin.orphans.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.orphans.index') }}"><i class="fa fa-child " style="font-size: 20px;"></i><span class="right-nav-text">الأيتام</span></a>
                </li>
            @endcan
            @can('إدارة كفالة الأيتام')
                <li class="{{ Route::is('admin.assign-orphans-to-sponsor.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.assign-orphans-to-sponsor.index') }}"><i class="fa fa-envelope-o" style="font-size: 17px;"></i><span class="right-nav-text"> كفالة الأيتام</span></a>
                </li>
            @endcan
            @can('إدارة التقارير')
                <li>
                    <a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#families_search"
                        aria-expanded="{{ Route::is('admin.families.search.index') || Route::is('admin.difficult-case-families.search.index') || Route::is('admin.special-needs-people.search.index') ? 'true' : 'false' }}">
                        <div class="pull-left"><i class="fa fa-search" style="font-size: 20px;"></i><span class="right-nav-text">التقارير</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="families_search"
                        class="collapse {{ Route::is('admin.families.search.index') || Route::is('admin.difficult-case-families.search.index') || Route::is('admin.special-needs-people.search.index') ? 'show' : '' }}"
                        data-parent="#sidebarnav">
                        @can('تقرير أسر الأيتام')
                            <li> <a href="{{ route('admin.families.search.index') }}" style="font-size: 13px;"> أسر الأيتام</a></li>
                        @endcan
                        @can('تقرير الأسر في وضعية صعبة')
                            <li> <a href="{{ route('admin.difficult-case-families.search.index') }}" style="font-size: 13px;">الأسر في وضعية صعبة</a></li>
                        @endcan
                        @can('تقرير المرضى وذوي الاحتياجات')
                            <li> <a href="{{ route('admin.special-needs-people.search.index') }}" style="font-size: 13px;">المرضى وذوي الاحتياجات </a></li>
                        @endcan
                        {{-- @can('تقرير دعم الأسر في وضعية صعبة')
                            <li> <a href="{{ route('admin.difficult-case-support-programs.search.index') }}" style="font-size: 13px;">دعم الأسر في وضعية صعبة</a></li>
                        @endcan
                        @can('تقرير دعم المرضى وذوي الاحتياجات')
                            <li> <a href="{{ route('admin.special_needs_people_support_programs.search.index') }}" style="font-size: 13px;">دعم المرضى وذوي الاحتياجات</a></li>
                        @endcan --}}
                    </ul>
                </li>
            @endcan
            @can('إدارة النسخ الإحتياطية')
                <li class="{{ Route::is('admin.backups.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.backups.index') }}"><i class="fa fa-users"></i><span class="right-nav-text">النسخ الاحتياطي</span></a>
                </li>
            @endcan
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
