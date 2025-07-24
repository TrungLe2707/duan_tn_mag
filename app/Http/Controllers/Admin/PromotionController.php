<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductCountDown;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = ProductCountDown::with('products')->get();
        $products = Products::all();

        return view('admin.countdown', ['promotions' => $promotions, 'products' => $products]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percent_discount' => 'required|numeric|min:1|max:100',
            'start_hour' => 'required',
            'end_hour' => 'required',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'status' => 'required|in:active,inactive',
        ]);

        $promotion = ProductCountDown::create($validated);
        $promotion->products()->sync($request->product_ids);

        // Cập nhật cột sale và price trong bảng products
        foreach ($request->product_ids as $productId) {
            $product = Products::find($productId);
            if ($product) {
                $product->sale += $validated['percent_discount'];
                if ($product->sale > 100) $product->sale = 100;
                $product->price = $product->original_price * (100 - $product->sale) / 100;
                $product->save();
            }
        }

        return redirect()->route('admin.countdown.index')->with('success', 'Khuyến mãi đã được tạo!');
    }

    public function update(Request $request, ProductCountDown $promotion)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'percent_discount' => 'required|numeric|min:1|max:100',
            'start_hour' => 'required',
            'end_hour' => 'required',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'status' => 'required|in:active,inactive',
        ]);

        // Nếu status chuyển từ active -> inactive thì trừ discount cũ
        if ($promotion->status === 'active' && $validated['status'] === 'inactive') {
            foreach ($promotion->products as $oldProduct) {
                $oldProduct->sale -= $promotion->percent_discount;
                if ($oldProduct->sale < 0) $oldProduct->sale = 0;
                $oldProduct->price = $oldProduct->original_price * (100 - $oldProduct->sale) / 100;
                $oldProduct->save();
            }
        }

        // Nếu status vẫn là active → cập nhật sản phẩm (trừ cũ, cộng mới)
        if ($promotion->status === 'active' && $validated['status'] === 'active') {
            foreach ($promotion->products as $oldProduct) {
                $oldProduct->sale -= $promotion->percent_discount;
                if ($oldProduct->sale < 0) $oldProduct->sale = 0;
                $oldProduct->price = $oldProduct->original_price * (100 - $oldProduct->sale) / 100;
                $oldProduct->save();
            }
        }

        $promotion->update($validated);
        $promotion->products()->sync($request->product_ids);

        // Nếu status là active → cộng discount mới cho sản phẩm mới
        if ($validated['status'] === 'active') {
            foreach ($request->product_ids as $productId) {
                $product = Products::find($productId);
                if ($product) {
                    $product->sale += $validated['percent_discount'];
                    if ($product->sale > 100) $product->sale = 100;
                    $product->price = $product->original_price * (100 - $product->sale) / 100;
                    $product->save();
                }
            }
        }

        return redirect()->route('admin.countdown.index')->with('success', 'Khuyến mãi đã được cập nhật!');
    }

    public function destroy($id)
    {
        $countDown = ProductCountDown::with('products')->findOrFail($id);

        // Trừ phần trăm giảm giá của countdown ra khỏi các sản phẩm
        foreach ($countDown->products as $product) {
            $product->sale -= $countDown->percent_discount;
            if ($product->sale < 0) $product->sale = 0;
            $product->price = $product->original_price * (100 - $product->sale) / 100;
            $product->save();
        }

        $countDown->products()->detach();
        $countDown->delete();

        return redirect()->route('admin.countdown.index')->with('success', 'Đã xóa chương trình khuyến mãi và cập nhật lại sản phẩm!');
    }
}
