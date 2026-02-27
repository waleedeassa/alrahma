<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> 403 - لم يتم العثور على الصفحة</title>
  <style>
    body {
      font-family: 'Cairo', Arial, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      text-align: center;
      padding: 0;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      direction: rtl;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 40px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.5s ease-in-out;
    }

    h1 {
      font-size: 100px;
      margin: 0;
      color: #e74c3c; 
      font-weight: 700;
    }

    h2 {
      font-size: 32px; 
      margin: 10px 0;
      color: #e74c3c; 
    }

    p {
      font-size: 20px; 
      margin: 20px 0;
      color: #000000; 
      font-weight: bold; 
    }

    .home-link {
      display: inline-block;
      margin-top: 30px;
      padding: 12px 30px;
      background-color: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-size: 16px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(52, 152, 219, 0.2);
    }

    .home-link:hover {
      background-color: #2980b9;
      transform: translateY(-2px);
      box-shadow: 0 6px 8px rgba(52, 152, 219, 0.3);
    }

    .error-image {
      max-width: 100%;
      height: 200px;
      margin-bottom: 30px;
      object-fit: contain;
    }

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

    /* تأثيرات */
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
  </style>
</head>

<body>
  <div class="container">
    <h1>403</h1>
    <h2>عذراً، ليس لديك الصلاحية للوصول إلى هذه الصفحة.</h2>
    <p>يرجى الاتصال بالمسؤول إذا كنت تعتقد أن هذا خطأ.</p>
    <a href="{{ route('admin.dashboard') }}" class="home-link">العودة إلى الصفحة الرئيسية</a>
  </div>
</body>

</html>