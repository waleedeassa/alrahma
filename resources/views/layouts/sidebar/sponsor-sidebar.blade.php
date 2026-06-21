<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <li class="{{ Route::is('sponsor.dashboard') ? 'active' : '' }}">
                <a href="{{ route('sponsor.dashboard') }}"><i class="ti-home"></i><span class="right-nav-text">لوحة التحكم</span> </a>
            </li>
            <li class="{{ Route::is('sponsor.sponsored-orphans') ? 'active' : '' }}">
                <a href="{{ route('sponsor.sponsored-orphans') }}"><i class="fa fa-child" style="font-size: 20px;"></i><span class="right-nav-text">الأيتام المكفولين </span> </a>
            </li>
            <li>
                <a href="{{ route('sponsor.unsponsored-orphans') }}"><i class="fa fa-user-plus"></i><span>الأيتام غير المكفولين</span></a>
            </li>

            <li>
                <a href="{{ asset('files/commitment-form.pdf') }}" download>
                    <i class="fa fa-download"></i>
                    <span class="right-nav-text">تحميل نموذج الالتزام</span>
                </a>
            </li>

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
