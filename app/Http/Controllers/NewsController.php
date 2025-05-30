<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()->latest()->paginate(10);

        return view('news', compact('news'));
    }

    public function show($id)
    {
        $news = News::published()->findOrFail($id);
        $relatedNews = News::published()
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('news-detail', compact('news', 'relatedNews'));
    }
}
