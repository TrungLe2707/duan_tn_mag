<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminCustomerController extends Controller
{
    // Danh sách khách hàng (role = user, không bị xóa)
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // Tìm kiếm theo tên, email, id
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('id', $search);
            });
        }

        // Lọc theo trạng thái hoạt động (is_locked)
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_locked', $request->status);
        }

        // Không hiển thị khách hàng đã bị xóa mềm
        $customers = $query->orderByDesc('created_at')->paginate(10);

        return view('admin.quanlykhachhang', compact('customers'));
    }

    // Lấy thông tin chi tiết khách hàng
    public function show($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        return response()->json($user);
    }

    // Thêm khách hàng mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'phone'     => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->phone      = $request->phone;
        $user->address    = $request->address;
        $user->role       = 'user';
        $user->is_active  = 1;
        $user->is_locked  = 1;
        $user->password   = bcrypt('12345678'); // Mặc định password
        $user->save();

        return response()->json(['message' => 'Thêm khách hàng thành công!']);
    }

    // Cập nhật thông tin khách hàng
    public function update(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string|max:255',
            'is_locked'   => 'required|boolean',
            'lock_reason' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name         = $request->name;
        $user->phone        = $request->phone;
        $user->address      = $request->address;
        $user->is_locked    = $request->is_locked;
        $user->lock_reason  = $request->is_locked == 0 ? $request->lock_reason : null;
        $user->save();

        return response()->json(['message' => 'Cập nhật thành công!']);
    }

    // Xóa mềm khách hàng
    public function destroy($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $user->delete(); // Xóa mềm

        return response()->json(['message' => 'Xoá khách hàng thành công!']);
    }

    // Khóa / Mở khóa tài khoản
    public function lockToggle(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        $user->is_locked = $request->is_locked;
        $user->lock_reason = $request->is_locked == 0 ? $request->lock_reason : null;
        $user->save();

        return response()->json(['message' => 'Cập nhật trạng thái hoạt động thành công!']);
    }
}
