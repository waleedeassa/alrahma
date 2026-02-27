<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Factories</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ URL::asset('backend/assets/images/fav-icon/fav.ico') }}" />
  <!-- Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/assets/css/style2.css') }}" />  

  <style>
    .login {
      background: linear-gradient(180deg, #003e55 30%, #8D7257);
    }

    @media (max-width: 767px) {
      .login.height-100vh {
        height: 100% !important;
      }
    }

    .login .login-fancy {
      background: rgb(254 249 232 / 85%);
      border-radius: 10px;
    }

    .login h3 {
      text-align: center;
      font-size: 38px;
    }

    img.logo {
      width: 350px;
    }

    .department {
      max-width: 270px;
      background: #ffffffb8;
      color: #103730;
      border-radius: 20px;
      padding: 15px;
      margin: 12px 16px;
      transition: all .3s linear;
      box-shadow: 0px 2px 6px 0px #003e55
    }

    .department:hover {
      /* box-shadow: 0 0 5px 0px #ED982A; */
    }

    .department p {
      color: #000
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <section class="height-100vh  page-section-ptb login pt-4" style="">
      <div class="container">
        <div class="row justify-content-center g-0 mb-4">
          <img class="logo" src="{{ asset('backend/assets/images/logo/logo-with-text.png') }} ">
        </div>
        <div class="row justify-content-center no-gutters vertical-align">
          <div class=" algn-items-center flex-grow-1 ">
            <div class="login-fancy pb-40 clearfix">
              <div class="form-inline d-flex justify-content-center flex-wrap">
                <a class="department d-flex justify-content-center flex-column text-center  align-items-center flex-grow-1 " title="" href="{{ route('admin.login') }}">
                  <img class="logo" src="{{ asset('backend/assets/images/login-icon/manager.svg') }} " width="80px" height="80px">
                  <p class="fs-3 mt-2 fw-bold">الادارة </p>
                </a>
                <a class="department d-flex justify-content-center flex-column text-center   align-items-center flex-grow-1 " title="" href="{{ route('sponsor.login') }}">
                  <img class="logo" src="{{ asset('backend/assets/images/login-icon/representative.svg') }} " width="80px" height="80px">
                  <p class="fs-3 mt-2 fw-bold">الكفلاء</p>
                </a>
                {{-- <a class="department d-flex justify-content-center flex-column text-center align-items-center flex-grow-1 " title="" href="{{ route('customer-services.login') }}">
                  <img class="logo" src="{{ asset('backend/assets/images/login-icon/call-cente-1.svg') }} " width="80px" height="80px">
                  <p class="fs-3 mt-2 fw-bold"> {{ __('factories.Customer service') }}</p>
                </a> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>

</html>