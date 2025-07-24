<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $wishlistItems = Wishlist::with('product')
                ->where('user_id', auth()->id())
                ->get()
                ->pluck('product');
        } else {
            $wishlist = session('wishlist', []);
            $wishlistItems = Products::whereIn('id', $wishlist)->get();
        }

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function add($productId)
    {
        if (auth()->check()) {
            Wishlist::firstOrCreate([
                'user_id' => auth()->id(),
                'product_id' => $productId
            ]);
        } else {
            $wishlist = session()->get('wishlist', []);
            if (!in_array($productId, $wishlist)) {
                $wishlist[] = $productId;
                session()->put('wishlist', $wishlist);
            }
        }

        return back()->with('success', 'Đã thêm vào danh sách yêu thích.');
    }

    public function remove($productId)
    {
        if (auth()->check()) {
            Wishlist::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->delete();
        } else {
            $wishlist = session()->get('wishlist', []);
            $wishlist = array_filter($wishlist, fn ($id) => $id != $productId);
            session()->put('wishlist', $wishlist);
        }

        return back()->with('success', 'Đã xóa khỏi danh sách yêu thích.');
    }

    public function clear()
    {
        if (auth()->check()) {
            Wishlist::where('user_id', auth()->id())->delete();
        } else {
            session()->forget('wishlist');
        }

        return back()->with('success', 'Đã xóa tất cả sản phẩm yêu thích.');
    }

}

