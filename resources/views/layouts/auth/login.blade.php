<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="HTML5 Template" />
  <meta name="description" content="" />

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title> @yield('title')</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ URL::asset('dashboard/assets/images/fav-icon/fav.ico') }}" />

  <!-- Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

  <!-- css -->

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/assets/css/style2.css') }}" />  

    <style>
  .login{
    background: linear-gradient(180deg, #003e55 30%, #8D7257);
  }
       .login .login-fancy{
        background: rgb(255 255 255 / 80%);
        border-radius: 10px;
       }
       .login h4{
        font-family: 'Cairo', 'sans-serif';
        text-align:center;
        font-weight:bold;
        font-size:30px;
        color:#000
       }
       .text-danger,.invalid-feedback{
        color: #870101 !important;
       }
        img.logo{
        width: 150px;
       }
       .btn-orange{
        background: #ED982A;
        border-color: #ED982A;
        color: #000;
        margin: auto;
        font-weight: bold;
        display: block;
        width: 200px;
        margin-top: 40px;
        font-size: 18px;
       }
       
       @media(max-width: 767px){
         .login{
          height: 100%!important;
         }
       }
      </style>
</head>

<body>

  <div class="wrapper">

    <!--=================================
    preloader -->
    <div id="pre-loader">
      {{-- <img src="images/pre-loader/loader-01.svg" alt=""> --}}
      <img src="{{asset('dashboard/assets/images/pre-loader/loader-01.svg')}}" alt="">
    </div>
    <!--=================================
    preloader -->
    {{-- url('dashboard/assets/images/no_image.jpg') --}}
    <!--=================================  
    login-->
    {{-- <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url('dashboard/assets/images/back.jpg');"> --}}
    {{-- <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url('{{ asset('dashboard/assets/images/back.jpg') }}');"> --}}
      <section class="height-100vh d-flex align-items-center page-section-ptb login">
      <div class="container">
        {{-- <div class="row justify-content-center g-0 mb-4">
          <img class="logo" src="{{ asset('dashboard/assets/images/logo/logo-with-text.png') }} ">
        </div> --}}
        <div class="row justify-content-center g-0 vertical-align">

          <div class="col-lg-4 col-md-6">
            <div class="login-fancy clearfix">
              <h4 class="mb-30" style="">@yield('form_title')</h4>

              @if (Session::has('succ'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session::get('succ') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              @if (Session::has('inf'))
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>{{ session::get('inf') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              @if (Session::has('fail'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session::get('fail') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              @yield('form')

            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================
    login-->
  </div>



  <!--=================================
  jquery -->
  @include('layouts.footer-scripts')
  @stack('js')
</body>

</html>