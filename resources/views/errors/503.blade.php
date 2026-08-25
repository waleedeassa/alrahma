<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الموقع تحت الصيانة</title>

    <style>
        @font-face {
            font-family: 'Cairo';
            src: url('{{ asset('dashboard/assets/fonts/Cairo-Regular.ttf') }}') format('truetype');
            font-weight: 400;
        }

        @font-face {
            font-family: 'Cairo';
            src: url('{{ asset('dashboard/assets/fonts/Cairo-Bold.ttf') }}') format('truetype');
            font-weight: 700;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', Arial, sans-serif;
            background: #f8f9fa;
            color: #333;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            direction: rtl;
        }

        .container {
            width: 100%;
            max-width: 650px;
            padding: 55px 45px;
            background: #fff;
            border-radius: 18px;
            text-align: center;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.08),
                0 2px 8px rgba(0, 0, 0, 0.04);
            animation: fadeIn 0.6s ease-in-out;
        }

        .icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff4e5;
            border-radius: 50%;
            color: #f39c12;
            font-size: 52px;
        }

        h1 {
            font-size: 42px;
            margin: 0 0 12px;
            color: #2c3e50;
            font-weight: 700;
        }

        h2 {
            font-size: 24px;
            margin: 0 0 20px;
            color: #f39c12;
            font-weight: 700;
        }

        p {
            font-size: 17px;
            line-height: 2;
            margin: 0 auto;
            max-width: 520px;
            color: #7f8c8d;
            font-weight: 400;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 30px;
            padding: 9px 18px;
            background: #f8f9fa;
            border-radius: 30px;
            color: #7f8c8d;
            font-size: 14px;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            background: #f39c12;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        .home-link {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 30px;
            background: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(52, 152, 219, 0.2);
        }

        .home-link:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow:
                0 6px 12px rgba(52, 152, 219, 0.3);
        }

        .footer {
            margin-top: 35px;
            color: #bdc3c7;
            font-size: 13px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(243, 156, 18, 0.4);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(243, 156, 18, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(243, 156, 18, 0);
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 40px 25px;
            }

            .icon {
                width: 80px;
                height: 80px;
                font-size: 42px;
            }

            h1 {
                font-size: 32px;
            }

            h2 {
                font-size: 20px;
            }

            p {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="icon">
            ⚙
        </div>

        <h1>الموقع تحت الصيانة</h1>

        <h2>نعود إليكم قريبًا</h2>

        <p>
            نعمل حاليًا على إجراء بعض التحسينات والتحديثات
            لضمان تقديم تجربة أفضل لكم.
            نعتذر عن الإزعاج ونقدر صبركم وتفهمكم.
        </p>

        <div class="status">
            <span class="status-dot"></span>
            جاري العمل على تحديث الموقع
        </div>

        <div class="footer">
            شكرًا لثقتكم بنا
        </div>

    </div>

</body>

</html>
