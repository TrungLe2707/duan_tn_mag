<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewController extends Controller
{
    public function show_new()
    {
        $newList = News::paginate(3);  // 6 bài mỗi trang

        $newListView = News::orderBy('views', 'desc')->take(3)->get();

        $newestNew = News::orderBy('posted_date', 'desc')->take(3)->get();

        $highlightNews = News::select('*')
            ->selectRaw('(views / DATEDIFF(NOW(), posted_date + INTERVAL 1 DAY)) as score')
            ->orderByDesc('score')
            ->first();

        $data =  [
            "newList" => $newList,
            "newListView" => $newListView,
            "newestNew" => $newestNew,
            "highlightNews" => $highlightNews,
        ];
        return view('news/news', $data);
    }




    public function new_detail($id)
    {
        $new_detail = News::where('id', $id)->first();
        if ($new_detail) {
            // Tăng lượt xem lên 1
            $new_detail->views += 1;
            $new_detail->save();
        }
        $data =  ["new_detail" => $new_detail];
        return view('news/new_detail', $data);
    }



    public function news_all()
    {
        $news_all = News::paginate(6);

        $data =  ["news_all" => $news_all];
        return view('news/news_all', $data);
    }
}
