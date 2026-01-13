<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewController extends Controller
{
    public function index()
    {
        // إضافة images للـ eager loading
        $news = News::with(['translations', 'images'])
            ->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->get();
            
        $first_news = $news->first();

        return view('site.pages.news.index', compact('news', 'first_news'));
    }

    public function show(News $news)
    {
        $news->load(['translations', 'images']);

        return view('site.pages.news.show', compact('news'));
    }
}