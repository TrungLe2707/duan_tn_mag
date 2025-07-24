<!DOCTYPE html>
<html>
<head>
    <title>Xác thực tài khoản</title>
    <style>
        /* Reset CSS */
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f7f9fc;
        }
        
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            padding: 40px 20px;
            text-align: center;
        }
        
        .logo {
            color: white;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 1px;
        }
        
        .content {
            padding: 40px;
        }
        
        h1 {
            color: #2d3748;
            margin-top: 0;
            font-size: 24px;
        }
        
        .welcome-text {
            font-size: 16px;
            margin-bottom: 25px;
            color: #4a5568;
        }
        
        .button {
            display: inline-block;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white !important;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 16px;
            margin: 25px 0;
            text-align: center;
            box-shadow: 0 4px 15px rgba(255, 75, 43, 0.3);
            transition: all 0.3s ease;
        }
        
        .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(255, 75, 43, 0.4);
        }
        
        .secondary-text {
            font-size: 14px;
            color: #718096;
            margin-top: 30px;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            background: #edf2f7;
            color: #718096;
            font-size: 12px;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-icon {
            display: inline-block;
            margin: 0 10px;
            color: #4a5568;
            text-decoration: none;
            font-weight: bold;
        }
        
        .contact-link {
            color: #4299e1;
            text-decoration: none;
        }
        
        .highlight {
            font-weight: bold;
            color: #2d3748;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ config('app.url') }}" class="logo">
                MAG
            </a>
        </div>
        
        <div class="content">
            <h1>Chào mừng {{ $user->name }}!</h1>
            
            <p class="welcome-text">
                Cảm ơn bạn đã đăng ký tài khoản tại M A G. 
                Để hoàn tất đăng ký, vui lòng xác thực email của bạn bằng cách nhấn nút bên dưới:
            </p>
            
            <a href="{{ $verificationUrl }}" class="button">XÁC THỰC EMAIL</a>
            
            <p class="secondary-text">
                Nếu bạn không tạo tài khoản này, vui lòng bỏ qua email này. 
                Liên kết xác thực sẽ hết hạn sau {{ config('auth.verification.expire', 60) }} phút.
            </p>
            
            <p class="secondary-text">
                Nếu bạn gặp vấn đề khi nhấn nút "Xác thực Email", 
                sao chép và dán URL sau vào trình duyệt của bạn:<br>
                <span class="highlight">{{ $verificationUrl }}</span>
            </p>
        </div>
        
        <div class="footer">
            <div class="social-links">
                <a href="#" class="social-icon">Facebook</a>
                <a href="#" class="social-icon">Instagram</a>
                <a href="#" class="social-icon">Twitter</a>
            </div>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tất cả quyền được bảo lưu.</p>
            <p>
                Cần hỗ trợ? <a href="mailto:{{ config('mail.support_email') }}" class="contact-link">Liên hệ chúng tôi</a>
            </p>
            <p>
                Đây là email tự động, vui lòng không trả lời.
            </p>
        </div>
    </div>
</body>
</html>