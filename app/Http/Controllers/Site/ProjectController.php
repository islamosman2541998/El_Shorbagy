<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\News;
use App\Models\Partner;
use App\Models\Projects;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $perPage = 12;
        $projects = Projects::with('translations')->where('status', 1)
            ->paginate($perPage)
            ->appends($request->except('page'));
        $whyus = WhyChooseUs::with('transNow')->first(); 
        $partners = Partner::with('translations')->where('status', 1)->get();

        $faq_questions = Faq::with('translations')->where('status', 1)->get();


        return view('site.pages.projects.index', compact('projects', 'faq_questions', 'whyus', 'partners'));
    }


    public function show(Projects $projects)
    {

        $projects = $projects->load('translations');
 $partners = Partner::with('translations')->where('status', 1)->get();

        $faq_questions = Faq::with('translations')->where('status', 1)->get();
        return view('site.pages.projects.show', compact('projects', 'faq_questions', 'partners'));
    }
}
