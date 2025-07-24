<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class SocialLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = $this->findOrCreateUser($googleUser, 'google');
            Auth::login($user, true);
            return redirect()->route('home');

        } catch (\Throwable $e) {
            \Log::error('Google login error: ' . $e->getMessage());

            return redirect()->route('login')
                ->withErrors('Đăng nhập bằng Google thất bại: ' . $e->getMessage());
        }
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $user = $this->findOrCreateUser($facebookUser, 'facebook');

            Auth::login($user, true);

            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Đăng nhập bằng Facebook thất bại: ' . $e->getMessage());
        }
    }
    private function findOrCreateUser($socialUser, $provider)
    {

        // Tìm user bằng email
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Cập nhật thông tin provider nếu chưa có
            if (empty($user->provider)) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                ]);
            }
            return $user;
        }

        // Tạo user mới nếu không tồn tại
        return User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'avatar' => $socialUser->getAvatar(),
            'password' => bcrypt(uniqid()), // Tạo password ngẫu nhiên
            'is_active' => 1, // Tự động active tài khoản đăng nhập mạng xã hội
        ]);
    }


}
