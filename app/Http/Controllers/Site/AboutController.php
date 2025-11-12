<?php

namespace App\Http\Controllers\Site;

use App\Models\About;
use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {

        $about_us = About::with('translations')->first();
                $statistics = Statistic::with('transNow')->feature()->active()->orderBy('sort','ASC')->get();    

        $trans = $about_us->translate(app()->getLocale()) ?? $about_us->translate(config('app.fallback_locale'));
        $coreValues = [];

        if ($trans && $trans->core_values) {
            $raw = $trans->core_values;
            $coreValues = is_array($raw) ? $raw : (json_decode($raw, true) ?? []);
        }
        return view('site.pages.about.index', compact('about_us', 'statistics'));
    }
}
