<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Product_categories;
use App\Models\sizes;

class ProductController extends Controller
{
    public function ProductAll(Request $request)
    {
        $query = Products::with(['thumbnail', 'variants' => function ($q) {
            $q->where('quantity', '>', 0);
            // $q->where('is_active', '>', 0);
        }])
        ->where('is_active', '>', 0)
        ->whereHas('variants', function ($q) {
            $q->where('quantity', '>', 0);
            // $q->where('is_active', '>', 0);
        })
        ->select('id', 'name', 'sale', 'price', 'original_price');

        if ($request->has('category') && ($request->category)) {
            $query->whereIn('category_id', $request->category);
        }

        if ($request->has('size') && $request->size != '') {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('size_id', $request->size)->where('quantity', '>', 0);
            });
        }

        if ($request->has('price')) {
            switch ($request->price) {
                case 1:
                    $query->where('price', '<', 100000);
                    break;
                case 2:
                    $query->whereBetween('price', [100000, 200000]);
                    break;
                case 3:
                    $query->whereBetween('price', [200000, 300000]);
                    break;
                case 4:
                    $query->where('price', '>', 300000);
                    break;
            }
        }

        $productAll = $query->paginate(12)->appends(request()->query());
        $total = $productAll->total();

        $categories = Product_categories::select('id', 'name')->get();
        $sizes = sizes::select('id', 'name')->get();

        return view('product', compact('productAll', 'total', 'categories', 'sizes'));
    }

    public function ProductFeatured()
    {
        $productAll = Products::with('thumbnail')
            ->where('is_featured', 1)
            ->where('is_active', '>', 0)
            ->select('id', 'name', 'sale', 'price', 'original_price')
            ->paginate(12);

        $total = $productAll->total();
        $categories = Product_categories::select('id', 'name')->get();
        $sizes = sizes::select('id', 'name')->get();

        return view('product', compact('productAll', 'total', 'categories', 'sizes'));
    }

    public function ProductBestseller()
    {
        $productAll = Products::with('thumbnail')
            ->orderBy('sold_count', 'desc')
            ->select('id', 'name', 'sale', 'price', 'original_price', 'sold_count')
            ->paginate(12);

        $total = $productAll->total();
        $categories = Product_categories::select('id', 'name')->get();
        $sizes = sizes::select('id', 'name')->get();

        return view('product', compact('productAll', 'total', 'categories', 'sizes'));
    }

    public function ProductPriceLowToHight()
    {
        $productAll = Products::with('thumbnail')
            ->orderBy('price', 'asc')
            ->select('id', 'name', 'sale', 'price', 'original_price', 'sold_count')
            ->paginate(12);

        $total = $productAll->total();
        $categories = Product_categories::select('id', 'name')->get();
        $sizes = sizes::select('id', 'name')->get();

        return view('product', compact('productAll', 'total', 'categories', 'sizes'));
    }

    public function ProductPriceHightToLow()
    {
        $productAll = Products::with('thumbnail')
            ->orderBy('price', 'desc')
            ->select('id', 'name', 'sale', 'price', 'original_price', 'sold_count')
            ->paginate(12);

        $total = $productAll->total();
        $categories = Product_categories::select('id', 'name')->get();
        $sizes = sizes::select('id', 'name')->get();

        return view('product', compact('productAll', 'total', 'categories', 'sizes'));
    }

    // sp gơi ý tìm kiếm
    public function searchSuggestions(Request $request)
    {
        $keyword = $request->get('keyword');

        $products = Products::with('thumbnail')
            ->where('name', 'like', '%' . $keyword . '%')
            ->take(5)
            ->get();

        $results = $products->map(function ($product) {

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->thumbnail ? asset($product->thumbnail->path) : asset('img/kocoanh.png'),
            ];
        });

        return response()->json($results);
    }


    // kq tìm kiếm
    public function search(Request $request)
    {
        $keyword = trim($request->get('keyword'));

        if (empty($keyword)) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm!');
        }

        $productAll = Products::with('thumbnail')
            ->where('name', 'like', '%' . $keyword . '%')
            ->select('id', 'name', 'sale', 'price', 'original_price')
            ->paginate(12)
            ->appends(['keyword' => $keyword]);

        $total = $productAll->total();

        return view('searchpage', compact('productAll', 'total', 'keyword'));
    }
}
