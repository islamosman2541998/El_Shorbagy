<?php

namespace App\Http\Controllers\Site;

use App\Models\Occasion;
use App\Models\Services;
use App\Models\HomeSettingPage;
use App\Settings\SettingSingleton;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
 public function index()
    {
        $services = Services::with('trans')->where('status', 1)
            ->get();
         $home_page_settings = HomeSettingPage::with('transNow')->where('title_section', 'services')->first();


        return view('site.pages.services.index', compact('services', 'home_page_settings'));
    }

  
   public function show(Services $services)
    {
       
        $services->load('trans', 'images');

        return view('site.pages.services.show', compact('services'));
    }
}