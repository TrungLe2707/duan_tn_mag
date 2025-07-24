<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
     public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals(sha1(string: $user->email), $hash)) {
            abort(403, 'Xác thực không hợp lệ');
        }

        if (!$request->hasValidSignature()) {
            return redirect()->route('home')->with(
                'error',
                'Liên kết kích hoạt đã hết hạn hoặc không hợp lệ'
            );
        }

        if ($user->is_active == 0) {
            $user->update([
                'is_active' => 1,
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);

        return redirect()->route('home')->with(
            'status',
            'Kích hoạt tài khoản thành công! Bạn đã được đăng nhập.'
        );
    }
}
