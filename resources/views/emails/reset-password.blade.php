<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>إعادة تعيين كلمة المرور</title>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #f5f6fa;
      font-family: 'Cairo', sans-serif;
      line-height: 1.6;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .header {
      padding: 32px;
      border-bottom: 1px solid #eee;
      text-align: center;
    }

    .logo {
      width: 120px;
      height: auto;
    }

    .content {
      padding: 32px;
      color: #2d3436;
    }

    h1 {
      color: #2c3e50;
      margin: 0 0 24px 0;
      font-size: 28px;
    }

    .btn {
      display: inline-block;
      background: #3498db;
      color: white !important;
      padding: 14px 32px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: all 0.3s;
      margin: 20px 0;
    }

    .btn:hover {
      background: #2980b9;
      transform: translateY(-2px);
    }

    .footer {
      padding: 24px;
      text-align: center;
      color: #636e72;
      font-size: 14px;
      border-top: 1px solid #eee;
    }

    .note {
      color: #e74c3c;
      font-size: 14px;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <img src="{{ asset('front/images/white logo.png') }}" alt="logo" class="logo">
    </div>

    <div class="content">
      <h1>إعادة تعيين كلمة المرور</h1>
      <p>مرحبا</p>
      <p>تم استلام طلب إعادة تعيين كلمة المرور</p>

      <center>
        <a href="{{ $actionURL }}" class="btn">تغيير كلمة المرور</a>
      </center>

      <p class="note">
       ملاحظة:  تنتهى صلاحية الرابط بعد 15 دقيقة
      </p>

      <p> إذا لم تطلب هذا، يمكنك تجاهل الرسالة</p>
    </div>

    <div class="footer">
      <p>© {{ date('Y') }} لشركة جميع الحقوق محفوظة</p>
    </div>
  </div>
</body>

</html>