<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
@include('layouts.head')
@stack('css')
</head>
<body>
  <div class="wrapper">
    <!--=================================
    preloader -->
    <div id="pre-loader">
      <img src="{{asset('dashboard/assets/images/pre-loader/loader-02.svg')}}" alt="">
    </div>
    <!--=================================
    header start-->
    @include('layouts.main-header')
    
    <!--=================================
    header End-->

    <!--=================================
    Main content -->
    <div class="container-fluid">
      <!-- Left Sidebar -->
      {{-- @include('layouts.sidebar') --}}
      @if(Auth::guard('web')->check())
      @include('layouts.sidebar.admin-sidebar')
      @elseif(Auth::guard('sponsor')->check())
      @include('layouts.sidebar.sponsor-sidebar')
      @endif 


      <!-- Left Sidebar End-->
      <!--=================================
      wrapper -->
        <div class="content-wrapper">
          @section('page-header')
          <div class="page-title">
            <div class="row">
              <div class="col-sm-6">
                <h4 style="font-family: 'Cairo', sans-serif;" class="mb-0"> @yield('breadcrumpTitle')</h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pe-0 float-start float-sm-end">
                  @section('breadcrump')
                  @if(Auth::guard('web')->check())
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="default-color">الرئيسية</a></li>
                  @elseif(Auth::guard('sponsor')->check())
                  <li class="breadcrumb-item"><a href="{{ route('sponsor.dashboard') }}" class="default-color">الرئيسية</a></li>
                  @endif
                  @show
                </ol>
              </div>
            </div>
          </div>
          @yield('page-header')
          @yield('content')
        <!-- widgets -->
        <!--=================================
        footer -->
        @include('layouts.footer')

        <!--=================================
        footer -->
      </div>
      <!-- main content wrapper end-->
    </div>
    <!--=================================
    Main content -->
  </div>
  <!--=================================
  jquery -->
  @include('layouts.footer-scripts')

  @stack('js')

</body>
</html>
