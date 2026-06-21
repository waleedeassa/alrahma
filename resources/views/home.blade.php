<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>مؤسسة الرحمة</title>
    <link rel="icon" type="image/png" href="/dashboard/assets/images/fav-icon/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap">
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
            --accent: #c4ac7c;
            --card-bg: rgba(255, 255, 255, 0.94);
            --radius: 16px;
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
        .page-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2.5rem;
            width: 100%;
            max-width: 680px;
        }
        .logo-wrap {
            background: #fff;
            border-radius: 50%;
            width: 140px;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 12px;
        }
        .logo-wrap img {
            width: 100%;
            max-width: 100%;
        }
        .card-panel {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 2.5rem 2rem;
            width: 100%;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }
        .card-panel h2 {
            text-align: center;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 2rem;
        }
        .entries {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1.25rem;
        }
        .entry-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 2rem 1rem 1.75rem;
            background: #fff;
            border: 2px solid transparent;
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--primary);
            box-shadow: 0 2px 10px rgba(41, 96, 96, 0.1);
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
        }
        .entry-btn:hover {
            transform: translateY(-5px);
            border-color: var(--secondary);
            box-shadow: 0 10px 28px rgba(41, 96, 96, 0.18);
        }
        .entry-btn .icon-wrap {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #f0f7f7;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.22s;
        }
        .entry-btn:hover .icon-wrap {
            background: #e0f0f0;
        }
        .entry-btn svg {
            width: 44px;
            height: 44px;
        }
        .entry-btn span {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
        }
        @media (max-width: 480px) {
            .card-panel {
                padding: 1.75rem 1.25rem;
            }
            .entry-btn {
                padding: 1.5rem 0.75rem;
            }
            .entry-btn .icon-wrap {
                width: 64px;
                height: 64px;
            }
            .entry-btn svg {
                width: 36px;
                height: 36px;
            }
            .entry-btn span {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="logo-wrap">
            <img src="{{ asset('dashboard/assets/images/logo/logo2.png') }}" alt="شعار مؤسسة الرحمة">
        </div>
        <div class="card-panel">
            <h2>اختر نوع الدخول</h2>
            <div class="entries">
                <a class="entry-btn" href="{{ route('admin.login') }}">
                    <div class="icon-wrap">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <circle cx="24" cy="13" r="6.5" stroke="#296060" stroke-width="2.4" />
                            <path d="M10 38c0-7.18 6.268-13 14-13s14 5.82 14 13" stroke="#296060" stroke-width="2.4" stroke-linecap="round" />
                            <path d="M24 22l-6 2.5v5c0 3.5 2.5 6.5 6 7.5 3.5-1 6-4 6-7.5v-5L24 22z" fill="#eef5f5" stroke="#c4ac7c" stroke-width="1.8" stroke-linejoin="round" />
                            <path d="M21 30l2.5 2.5 4-4" stroke="#296060" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span>الإدارة</span>
                </a>
                <a class="entry-btn" href="{{ route('sponsor.login') }}">
                    <div class="icon-wrap">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M24 15c0 0-1.5-3.5-5-3.5A5 5 0 0014 17c0 5 10 12 10 12s10-7 10-12a5 5 0 00-5-5.5c-3.5 0-5 3.5-5 3.5z" fill="#eef5f5" stroke="#c4ac7c" stroke-width="1.8" stroke-linejoin="round" />
                            <path d="M10 34h5l3-3h8l5 1" stroke="#296060" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10 34v4h4v-4" stroke="#296060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M31 32l5-1.5a2 2 0 011 3.5L24 38H10" stroke="#296060" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span>الكفلاء</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
