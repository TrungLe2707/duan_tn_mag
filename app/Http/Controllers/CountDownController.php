<?php

namespace App\Http\Controllers;

use App\Models\ProductCountDown;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CountDownController extends Controller
{
    /**
     * Áp dụng chương trình Countdown nếu đã đến giờ bắt đầu
     */
    public function applyCountdown()
    {
        $now = Carbon::now()->format('H:i');

        $countdowns = ProductCountDown::where('status', 'active')
            ->where('applied', false) // chưa áp dụng
            ->where('start_hour', '<=', $now) // đã tới giờ bắt đầu
            ->with('products')
            ->get();

        foreach ($countdowns as $countdown) {
            foreach ($countdown->products as $product) {
                $originalSale = floatval($product->sale);
                $countdownSale = floatval($countdown->percent_discount);
                $newSale = min($originalSale + $countdownSale, 100);

                $product->sale = $newSale;
                $product->price = round($product->original_price * (1 - $newSale / 100), 2);
                $product->save();
            }

            $countdown->applied = true; // đã áp dụng rồi
            $countdown->save();
        }

        return response()->json([
            'success' => true,
            'message' => '⏱️ Countdown đã được áp dụng.',
            'count' => $countdowns->count(),
            'reload_page' => $countdowns->count() > 0 // reload nếu có countdown mới áp dụng
        ]);
    }

    /**
     * Reset chương trình Countdown nếu đã hết giờ
     */
    public function resetCountdownSale()
    {
        $now = Carbon::now()->format('H:i');

        $expiredCountdowns = ProductCountDown::where('status', 'active')
            ->where('applied', true) // chỉ reset nếu đã từng áp dụng
            ->where('end_hour', '<', $now) // đã quá giờ kết thúc
            ->with('products')
            ->get();

        foreach ($expiredCountdowns as $countdown) {
            foreach ($countdown->products as $product) {
                $productSale = floatval($product->sale);
                $countdownSale = floatval($countdown->percent_discount);

                $product->sale = max(0, $productSale - $countdownSale);
                $product->save();
            }

            $countdown->applied = false; // đánh dấu chưa áp dụng lại
            // $countdown->status = 'inactive'; // có thể dùng nếu muốn dừng luôn
            $countdown->save();
        }

        return response()->json([
            'success' => true,
            'message' => '✅ Countdown đã hết giờ, giá đã reset.',
            'reload_page' => $expiredCountdowns->count() > 0
        ]);
    }
}
