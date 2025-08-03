<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminBaocaoController extends Controller
{
public function index() {
    $orders = Order::with(['user', 'address', 'orderDetails.productVariant.product'])
        ->where('status', 'thành công')
        ->orderBy('created_at', 'desc')
        ->get();

    $totalRevenue = 0;
    $totalProfit = 0;
$totalDetails = 0;
    foreach ($orders as $order) {
        foreach ($order->orderDetails as $detail) {
            $price = $detail->productVariant->product->price ?? 0;
            $originalPrice = $detail->productVariant->product->original_price ?? 0;
            $quantity = $detail->quantity;

            $totalRevenue += $price * $quantity;
            $totalProfit += ($price - $originalPrice) * $quantity;
               $totalDetails++; 
        }
    }
 $data = [
        'orders' => $orders,
        'totalRevenue' => $totalRevenue,
        'totalProfit' => $totalProfit,
        'totalDetails' => $totalDetails,
        ];
   return view('admin.baocao', $data);
}

public function filter(Request $request)
{
    $startDate = $request->startDate;
    $endDate = $request->endDate;
    $startTime = $request->startTime;
    $endTime = $request->endTime;
    $timeRange = $request->timeRange;
    $reportType = $request->reportType;
    $category = $request->category;

    // Gộp datetime
    $startDateTime = Carbon::parse("$startDate $startTime");
    $endDateTime = Carbon::parse("$endDate $endTime");

    // Query đơn hàng thành công
    $orders = Order::with(['user', 'address', 'orderDetails.productVariant.product.category'])
        ->where('status', 'thành công')
        ->whereBetween('created_at', [$startDateTime, $endDateTime])
        ->get();

    // Lọc theo khung giờ (nếu chọn)
    if ($timeRange !== 'all') {
        $orders = $orders->filter(function ($order) use ($timeRange) {
            $hour = Carbon::parse($order->created_at)->hour;

            return match ($timeRange) {
                'morning' => $hour >= 6 && $hour < 12,
                'afternoon' => $hour >= 12 && $hour < 18,
                'evening' => $hour >= 18 && $hour <= 23,
                default => true,
            };
        });
    }

    // Lọc theo danh mục
    if ($category !== 'all') {
        $orders = $orders->filter(function ($order) use ($category) {
            foreach ($order->orderDetails as $detail) {
                if ($detail->productVariant->product->category->name === $category) {
                    return true;
                }
            }
            return false;
        });
    }

    // Tổng doanh thu và tổng đơn hàng
    $totalRevenue = 0;
    $totalDetails = 0;

    foreach ($orders as $order) {
        foreach ($order->orderDetails as $detail) {
            // Nếu có lọc theo danh mục thì loại bỏ những sản phẩm không thuộc danh mục đó
            if ($category !== 'all' && $detail->productVariant->product->category->name !== $category) {
                continue;
            }

            $totalRevenue += $detail->productVariant->product->price * $detail->quantity;
            $totalDetails++;
        }
    }

    return view('admin.baocao', compact(
        'orders',
        'totalRevenue',
        'totalDetails',
        'startDate',
        'endDate',
        'startTime',
        'endTime',
        'timeRange',
        'reportType',
        'category'
    ));
}

}

