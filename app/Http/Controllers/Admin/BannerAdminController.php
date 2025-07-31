<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banners;

class BannerAdminController extends Controller
{
    public function index()
    {
        $banners = Banners::orderBy('sort_order')->get();
        return view('admin.quanlybanner', compact('banners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'        => 'nullable|string|max:255',
            'cta_text'    => 'nullable|string|max:100',
            'status'      => 'required|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/slider'), $filename);
            $data['image'] = 'img/slider/' . $filename;
        }

        Banners::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Thêm thành công!');

    }

    public function update(Request $request, $id)
    {
        $banner = Banners::findOrFail($id);

        $data = $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'        => 'nullable|string|max:255',
            'cta_text'    => 'nullable|string|max:100',
            'status'      => 'required|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/slider'), $filename);
            $data['image'] = 'img/slider/' . $filename;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $banner = Banners::findOrFail($id);

        // Xóa ảnh nếu có
        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Xoá thành công!');
    }
}
