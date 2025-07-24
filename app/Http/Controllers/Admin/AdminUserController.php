<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->where('role', '!=', 'user');

        if ($request->email) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->role) {
            $query->where('role', $request->role);
        }

        if ($request->status != '') {
            $isActive = $request->status === 'active' ? 1 : 0;
            $query->where('is_active', $isActive);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.quanlynguoidung', compact('users'));
    }

   public function add(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'role' => 'required|in:admin,news_manager,products_manager,customer_service',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user->role !== 'user') {
        return response()->json(['error' => 'Người này đã có vai trò rồi.'], 400);
    }

    $user->role = $request->role;
    $user->is_active = 1; // Kích hoạt người dùng ngay khi thêm
    $user->save();

    return response()->json(['success' => 'Thêm thành công']);
}


    public function updateRoleAndStatus(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,news_manager,products_manager,customer_service',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->is_active = $request->status === 'active' ? 1 : 0;
        $user->save();

        return response()->json(['success' => 'Cập nhật thành công']);
    }

    public function removeRole($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->is_active = 0;
        $user->save();

        return response()->json(['success' => 'Đã đưa về vai trò người dùng']);
    }
}
