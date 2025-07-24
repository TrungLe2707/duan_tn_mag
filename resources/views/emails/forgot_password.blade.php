{{-- filepath: resources/views/emails/forgot_password.blade.php --}}
<p>Xin chào {{ $user->name }},</p>
<p>Bạn vừa yêu cầu đặt lại mật khẩu. Nhấn vào liên kết dưới đây để đặt lại mật khẩu:</p>
<p><a href="{{ $resetUrl }}">Đặt lại mật khẩu</a></p>
<p>Nếu bạn không yêu cầu, hãy bỏ qua email này.</p>