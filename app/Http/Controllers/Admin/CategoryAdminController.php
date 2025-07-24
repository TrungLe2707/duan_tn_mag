<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pro_categories = Product_categories::paginate(5); // chỉ lấy những cái chưa bị xóa mềm
        $data = [
            'categories' => $pro_categories,
        ];

        return view('admin.quanlydanhmuc', $data);
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
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        $iSlug = Str::slug($request->name);
        $slug = $iSlug;
        $i = 1;

        while (Product_categories::where('slug', $slug)->exists()) {
            $slug = $iSlug . '-' . $i;
            $i++;
        }


        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('/img/categories'), $filename);

        $category = new Product_categories();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $filename;
        $category->is_active = 1;
        $category->save();


        return back()->with('success', 'Tạo danh mục thành công');
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

public function update(Request $request, string $id)
{
    $category = Product_categories::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $category->name = $request->name;

    // Nếu người dùng có chọn ảnh mới
    if ($request->hasFile('image')) {
        $oldImage = public_path('img/categories/' . $category->image);
        if (File::exists($oldImage)) {
            File::delete($oldImage);
        }

        // Lưu ảnh mới

        // $file = $request->file('image');
        // $filename = time() . '_' . $file->getClientOriginalName();
        // $file->move(public_path('/img/categories'), $filename);

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/img/categories'), $imageName);
        $category->image = $imageName;
    }

    $category->save();

    return redirect()->back()->with('success', 'Cập nhật danh mục thành công!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Product_categories::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }

        // kiểm tra còn sp ko
        $productCount = $category->products()->count();

        if ($productCount > 0) {
            return redirect()->back()->with('error', 'Không thể xóa vì còn sản phẩm trong danh mục.');
        }

        // xóa luôn ảnh trong thư mục
        $filePath = public_path('img/categories/' . $category->image);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Xóa danh mục thành công.');
    }
}
