<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شكراً لتسجيلك</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background: linear-gradient(to right, #170e20, #2575fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .thank-you-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
            max-width: 400px;
            text-align: center;
        }
        .thank-you-card h2 {
            font-weight: bold;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #ff9800;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>
    <div class="thank-you-card">
        <h2>🎉 شكراً لتسجيلك! 🎉</h2>
        <p>تم استلام طلبك بنجاح. سيتم مراجعة بياناتك والرد عليك قريبًا.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">العودة إلى الصفحة الرئيسية</a>
    </div>
</body>
</html>
