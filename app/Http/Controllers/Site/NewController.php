<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewController extends Controller
{
    public function index()
    {
        $news = News::with(['translations', 'images'])
            ->where('status', 1)
            ->orderBy('sort', 'desc')
            ->get();
            

        return view('site.pages.news.index', compact('news'));
    }

    public function show(News $news)
    {
        $news->load(['translations', 'images']);

        return view('site.pages.news.show', compact('news'));
    }
}