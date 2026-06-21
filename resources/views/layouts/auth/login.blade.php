<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>@yield('title') — مؤسسة الرحمة</title>
    <link rel="shortcut icon" href="/dashboard/assets/images/fav-icon/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dashboard/assets/css/style2.css') }}" />
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #296060;
            --secondary: #c4ac7c;
            --primary-hover: #1e4a4a;
            --card-bg: rgba(255, 255, 255, 0.96);
            --input-border: #c8d4d4;
            --danger: #f52727;
            --radius: 12px;
        }

        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background-color: #1e4a4a;
            background-image:
                radial-gradient(at 0% 0%, #296060 0px, transparent 55%),
                radial-gradient(at 100% 0%, #1a3a3a 0px, transparent 50%),
                radial-gradient(at 100% 100%, #2d6060 0px, transparent 50%),
                radial-gradient(at 0% 100%, #3a7060 0px, transparent 50%),
                radial-gradient(at 50% 50%, #2d6868 0px, transparent 60%),
                url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.025'%3E%3Cpath d='M0 0h40v40H0zm40 40h40v40H40z'/%3E%3C/g%3E%3C/svg%3E");
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .auth-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
        }

        .auth-card-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.75rem;
        }

        .auth-card-header .icon-wrap {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #eef5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card-header svg {
            width: 36px;
            height: 36px;
        }

        .auth-card-header h4 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
            text-align: center;
            margin: 0;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.88rem;
            font-weight: 600;
        }

        .alert-success {
            background: #d4f4e2;
            color: #0a5c2e;
        }

        .alert-info {
            background: #d0eaf8;
            color: #0a3d5e;
        }

        .alert-danger {
            background: #fde8e8;
            color: var(--danger);
        }

        /* Form */
        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 0.4rem;
        }

        .form-group .form-control {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border: 1.5px solid var(--input-border);
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 0.95rem;
            color: #1a1a2e;
            background: #fff;
            transition: border-color 0.2s;
            outline: none;
        }

        .form-group .form-control:focus {
            border-color: var(--primary);
        }

        .form-group .form-control.is-invalid {
            border-color: var(--danger);
        }

        .text-danger,
        .invalid-feedback {
            color: var(--danger) !important;
            font-size: 0.82rem;
            margin-top: 0.3rem;
            display: block;
        }

        /* Buttons */
        .btn-auth {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: background 0.2s, transform 0.15s;
            margin-top: 0.75rem;
        }

        .btn-submit {
            background: var(--primary);
            color: #fff;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-back {
            background: transparent;
            color: var(--primary);
            border: 1.5px solid var(--primary);
        }

        .btn-back:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-1px);
        }

        .forgot-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.88rem;
        }

        .forgot-link a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link a:hover {
            text-decoration: underline;
        }

        .form-hint {
            font-size: 0.88rem;
            color: #5a6a72;
            text-align: center;
            margin-bottom: 1.25rem;
            line-height: 1.6;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 1.75rem 1.25rem;
            }
        }
    </style>
</head>

<body>
    <div id="pre-loader">
        <img src="{{ asset('dashboard/assets/images/pre-loader/loader-01.svg') }}" alt="">
    </div>

    <div class="auth-card">
        <div class="auth-card-header">
            @yield('header_icon')
            <h4>@yield('form_title')</h4>
        </div>

        @if (Session::has('succ'))
            <div class="alert alert-success">{{ session('succ') }}</div>
        @endif
        @if (Session::has('inf'))
            <div class="alert alert-info">{{ session('inf') }}</div>
        @endif
        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ session('fail') }}</div>
        @endif

        @yield('form')
    </div>

    @include('layouts.footer-scripts')
    @stack('js')
</body>

</html>
