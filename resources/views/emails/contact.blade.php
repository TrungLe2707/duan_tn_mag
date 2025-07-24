<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafc;
            padding: 20px;
            color: #333;
        }

        .info-box {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border-left: 5px solid #005baa;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        }

        h2 {
            color: #005baa;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .info-item {
            margin-bottom: 12px;
        }

        .info-item strong {
            display: inline-block;
            width: 130px;
            color: #555;
        }

        .message-content {
            background-color: #f0f4f8;
            padding: 15px;
            border-radius: 6px;
            white-space: pre-line;
        }
    </style>
</head>
<body>
    <div class="info-box">
        <h2>Thông tin liên hệ</h2>

        <div class="info-item"><strong>Họ và Tên:</strong> {{ $data['name'] }}</div>
        <div class="info-item"><strong>Email:</strong> {{ $data['email'] }}</div>

        @if(!empty($data['phone']))
            <div class="info-item"><strong>Số điện thoại:</strong> {{ $data['phone'] }}</div>
        @endif

        @if(!empty($data['subject']))
            <div class="info-item"><strong>Chủ đề:</strong> {{ $data['subject'] }}</div>
        @endif

        <div class="info-item"><strong>Nội dung:</strong></div>
        <div class="message-content">{{ $data['message'] }}</div>
    </div>
</body>
</html>
