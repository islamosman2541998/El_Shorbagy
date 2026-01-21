<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\News;
use App\Models\About;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Services;
use App\Models\PromoCode;
use App\Models\Statistic;
use App\Models\WhyChooseUs;
use App\Models\PaymentMethod;
use App\Models\HomeSettingPage;
use App\Models\ProductCategory;
use App\Models\AboutTranslation;
use App\Settings\SettingSingleton;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {

        $current_lang       = app()->getLocale();
        $about_us = About::with('transNow')->first();
        if (!$about_us) {
            $about_us = new About();
            $about_us->transNow = new AboutTranslation();
        }
        $blogs = Blog::with('translations')->where('status', 1)->take(3)->get();
        $partners = Partner::with('translations')->where('status', 1)->get();
        $news = News::with('translations')->where('status', 1)->take(3)->get();
        $faq_questions = Faq::with('translations')->where('status', 1)->get();

        $products = Product::with('transNow')->feature()->active()->orderBy('sort','ASC')->take(3)->get(); 
        $categoryProducts = ProductCategory::with('transNow')->feature()->active()->orderBy('sort','ASC')->get();  
        $statistics = Statistic::with('transNow')->feature()->active()->orderBy('sort','ASC')->get();    
        $services = Services::with('transNow')->feature()->active()->orderBy('sort','ASC')->get();   
        $whyus = WhyChooseUs::with('transNow')->first(); 
        $home_page_settings = HomeSettingPage::with('transNow')->where('title_section', 'services')->first();
        $galleries = Gallery::with('trans')
            ->active()
            ->orderBy('sort', 'ASC')
            ->get();
        // dd($home_page_settings);
       
        $page_name = 'home';

        return view('site.pages.index', compact(
            'current_lang',
            'page_name',
            'about_us',
            'products',
            'categoryProducts',
            'blogs',
            'partners',
            'news',
            'faq_questions',
            'statistics',
            'services',
            'whyus',
            'home_page_settings',
            'galleries'
        ));
    }
}
