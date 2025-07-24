<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
        $query = Order::with(['user', 'address'])->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('address', function ($q) use ($search) {
                    $q->where('phone', 'like', "%{$search}%")
                      ->orWhere('receiver_name', 'like', "%{$search}%");
                });
            });
        }

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($start_date) {
            $query->whereDate('created_at', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('created_at', '<=', $end_date);
        }

        $orders = $query->get();

        return view('admin.orders', compact('orders'));
    }

    public function softDelete($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return redirect()->route('admin.orders.index')->with('success', 'Đã xóa mềm đơn hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.index')->with('error', 'Không tìm thấy đơn hàng!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Chờ xử lý,Đã xác nhận,Đang giao hàng,Thành công,Đã hủy,Hoàn hàng',
        ]);

        $order = Order::findOrFail($id);
        if (in_array($order->status, ['Thành công', 'Đang giao hàng']) && $request->status === 'Đã hủy') {
            return redirect()->route('admin.orders.index')->with('error', 'Không thể chuyển trạng thái khi đang vận chuyển hoặc đã thành công!');
        }

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function show($id)
    {
        $order = Order::with([
            'user',
            'address',
            'orderDetails.productVariant.product.images',
            'orderDetails.productVariant.size',
            'orderDetails.productVariant.color'
        ])->findOrFail($id);

        // Gọi API địa chỉ để lấy tên tỉnh/thành, quận/huyện, xã/phường
        $addressData = $this->fetchAddressDetails($order->address);

        // Gán dữ liệu địa chỉ vào $order
        $order->address_details = $addressData;

        return view('admin.orders_show', compact('order'));
    }

    protected function fetchAddressDetails($address)
    {
        try {
           
            $baseUrl = 'https://provinces.open-api.vn/api/';

            // Lấy thông tin tỉnh/thành
            $provinceResponse = Http::get("{$baseUrl}p/{$address->province}?depth=1");
            $provinceName = $provinceResponse->successful() ? $provinceResponse->json()['name'] : 'Không xác định';

            // Lấy thông tin quận/huyện
            $districtResponse = Http::get("{$baseUrl}d/{$address->district}?depth=1");
            $districtName = $districtResponse->successful() ? $districtResponse->json()['name'] : 'Không xác định';

            // Lấy thông tin xã/phường
            $wardResponse = Http::get("{$baseUrl}w/{$address->ward}?depth=1");
            $wardName = $wardResponse->successful() ? $wardResponse->json()['name'] : 'Không xác định';

            return [
                'province_name' => $provinceName,
                'district_name' => $districtName,
                'ward_name' => $wardName,
                'address' => $address->address ?? 'Không xác định',
                'phone' => $address->phone ?? 'Không xác định',
                'receiver_name' => $address->receiver_name ?? 'Không xác định',
            ];
        } catch (\Exception $e) {
            // Xử lý lỗi API
            return [
                'province_name' => 'Không xác định',
                'district_name' => 'Không xác định',
                'ward_name' => 'Không xác định',
                'address' => $address->address ?? 'Không xác định',
                'phone' => $address->phone ?? 'Không xác định',
                'receiver_name' => $address->receiver_name ?? 'Không xác định',
            ];
        }
    }
    
}




