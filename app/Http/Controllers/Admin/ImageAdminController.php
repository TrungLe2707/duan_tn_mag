<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product_categories;
use App\Models\Product_images;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product_images::with('image_product.category') // load cả category
            ->orderBy('order')
            ->orderBy('product_id');

        // Lọc theo product_id
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        // Tìm theo tên sản phẩm
        if ($request->filled('search')) {
            $query->whereHas('image_product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Lọc theo tên danh mục
        if ($request->filled('category')) {
            $query->whereHas('image_product.category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $images = $query->get()->groupBy('product_id');

        // Lọc theo số lượng ảnh
        if ($request->filled('count')) {
            $count = (int) $request->count;
            $images = $images->filter(fn($group) => $group->count() == $count);
        }

        // Truyền danh sách danh mục để đổ dropdown
        $categories = Product_categories::orderBy('name')->pluck('name');

        return view('admin.quanlyhinhanh', [
            'image' => $images,
            'request' => $request,
            'categories' => $categories
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image' => 'required|image|max:2048',
        ]);

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Lưu file vào thư mục public/products
        $file->move(public_path('/img/products'), $filename);

        // gán order
        $image = new Product_images();
        $image->product_id = $request->product_id;
        $image->path = 'img/products/' . $filename;
        $image->order = 2;
        $image->save();

        return redirect()->back()->with('success', 'Thêm hình ảnh thành công');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */



    public function update(Request $request, $id)
    {
        $image = Product_images::findOrFail($id);

        // Nếu có ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            $oldPath = public_path($image->path);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Lưu ảnh mới
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/products'), $filename);
            $image->path = 'img/products/' . $filename;
        }

        // Cập nhật order (hình chính/phụ)
        if ($request->input('is_primary') == '1') {
            // Cập nhật các ảnh khác cùng sản phẩm về ảnh phụ
            Product_images::where('product_id', $image->product_id)
                ->where('id', '!=', $image->id)
                ->update(['order' => 2]);

            // Đặt ảnh này là ảnh chính
            $image->order = 1;
        } else {
            // Nếu chọn là ảnh phụ
            $image->order = 2;
        }

        $image->save();

        return redirect()->back()->with('success', 'Cập nhật hình ảnh thành công');
    }






    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $image = Product_images::findOrFail($id);
        $productId = $image->product_id;

        // Kiểm tra nếu là ảnh chính và là ảnh duy nhất
        $imagesCount = Product_images::where('product_id', $productId)->get();
        $wasPrimary = $image->order == 1;

        if ($wasPrimary && $imagesCount->count() == 1) {
            return redirect()->back()->with('error', 'Không thể xóa ảnh chính vì đây là ảnh duy nhất của sản phẩm.');
        }

        // Xóa file trong public (nếu tồn tại)
        $filePath = public_path($image->path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Xóa trong DB
        $image->delete();

        // Nếu là ảnh chính, gán ảnh khác làm ảnh chính
        if ($wasPrimary) {
            $nextImage = Product_images::where('product_id', $productId)->first();
            if ($nextImage) {
                $nextImage->order = 1;
                $nextImage->save();
            }
        }

        return redirect()->back()->with('success', 'Đã xóa hình ảnh thành công');
    }
}
