<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Vui lòng nhập tên đăng nhập hoặt email.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ]);
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        if ($user && $user->is_active == 0) {
            return back()->withErrors([
                'email' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email để kích hoạt.',
            ])->withInput();
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->is_active == 0) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email để kích hoạt.',
                ])->withInput();
            }
            if (Auth::user()->is_locked == 0) {
        Auth::logout();

        return back()->withErrors([
            'email' => 'Tài khoản của bạn đã bị khóa.',
        ])->withInput();
    }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->withInput();
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'name.max' => 'Họ tên không được vượt quá 50 ký tự.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => 0,
        ]);
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(config('auth.verification.expire', 60)),
            parameters: ['id' => $user->id, 'hash' => sha1($user->email)]
        );


        try {
            Mail::to(users: $user->email)->send(new WelcomeMail($user, $verificationUrl));
        } catch (\Exception $e) {
            \Log::error('Mail Error: ' . $e->getMessage());
        }


        return redirect()->route('home')->with(
            'status',
            'Đăng ký thành công! Vui lòng kiểm tra email để xác thực tài khoản.'
        );
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('showlogin');
    }

    protected function authenticated(Request $request, $user)
    {
        // Lấy giỏ hàng từ session
        $sessionCart = session()->get('cart', []);

        // Đồng bộ với database
        foreach ($sessionCart as $item) {
            $cartItem = \App\Models\Cart::firstOrNew([
                'user_id' => $user->id,
                'product_variant_id' => $item['product_variant_id'],
            ]);
            $cartItem->quantity += $item['quantity'];
            $cartItem->save();
        }

        // Xóa giỏ hàng trong session
        session()->forget('cart');

        return redirect('/');
    }

    public function ForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.'])->withInput();
        }

        // Tạo link đặt lại mật khẩu (dùng route có sẵn hoặc tự tạo)
        $resetUrl = URL::temporarySignedRoute(
            'password.reset', // Đảm bảo bạn có route này
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        try {
            \Mail::to($user->email)->send(new \App\Mail\ForgotPasswordMail($user, $resetUrl));
        } catch (\Exception $e) {
            \Log::error('Mail Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Không gửi được email. Vui lòng thử lại sau.']);
        }

        return back()->with('status', 'Đã gửi hướng dẫn đặt lại mật khẩu đến email của bạn.');
    }
    public function showResetForm(Request $request, $id, $hash)
    {
        // Kiểm tra link hợp lệ
        if (!$request->hasValidSignature()) {
            abort(403, 'Link không hợp lệ hoặc đã hết hạn.');
        }
        $user = User::findOrFail($id);
        if (sha1($user->email) !== $hash) {
            abort(403, 'Link không hợp lệ.');
        }
        return view('emails.auth.reset-password', ['user' => $user]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::findOrFail($request->id);
        $user->password = \Hash::make($request->password);
        $user->save();

        return redirect()->route('showlogin')->with('status', 'Đặt lại mật khẩu thành công! Bạn có thể đăng nhập.');
    }
}
