<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\AboutRequest;

class WhyChooseUsController extends Controller
{
 
    public function edit()
    {
   
        $why_choose_us = WhyChooseUs::with('translations')->first();

     
        if (!$why_choose_us) {
            $why_choose_us = WhyChooseUs::create([
                'image' => null,
                'image_background' => null,
                'status' => true,
                'sort' => 0,
                'created_by' => Auth::id(),
            ]);
        }
        $languages = config('translatable.locales', ['en']);
        return view('admin.dashboard.why_choose_us.single', compact('why_choose_us', 'languages'));
    }


    public function update(AboutRequest $request)
    {
        $why_choose_us = WhyChooseUs::first();
        if (!$why_choose_us) {
            $why_choose_us = WhyChooseUs::create([
                'status' => true,
                'sort' => 0,
                'created_by' => Auth::id(),
            ]);
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($why_choose_us->image) Storage::disk('public')->delete($why_choose_us->image);
            $why_choose_us->image = $request->file('image')->store('attachments/why_choose_us', 'public');
        }

    
     

        $why_choose_us->status = isset($data['status']) ? (bool)$data['status'] : $why_choose_us->status;
        $why_choose_us->sort = $data['sort'] ?? $why_choose_us->sort;
        $why_choose_us->updated_by = Auth::id();
        $why_choose_us->save();

        $locales = config('translatable.locales', ['en']);
        foreach ($locales as $locale) {
            $trans = $request->input($locale, []);
            $why_choose_us->translateOrNew($locale)->title = $trans['title'] ?? null;
            $why_choose_us->translateOrNew($locale)->subtitle = $trans['subtitle'] ?? null;
            $why_choose_us->translateOrNew($locale)->description = $trans['description'] ?? null;
            $why_choose_us->translateOrNew($locale)->sub_description = $trans['sub_description'] ?? null;

            $why_choose_us->translateOrNew($locale)->our_story_title = $trans['our_story_title'] ?? null;
            $why_choose_us->translateOrNew($locale)->our_story_description = $trans['our_story_description'] ?? null;

            $why_choose_us->translateOrNew($locale)->ceo_title = $trans['ceo_title'] ?? null;
            $why_choose_us->translateOrNew($locale)->ceo_description = $trans['ceo_description'] ?? null;

            $why_choose_us->translateOrNew($locale)->vision = $trans['vision'] ?? null;
            $why_choose_us->translateOrNew($locale)->mission = $trans['mission'] ?? null;
            $why_choose_us->translateOrNew($locale)->at_a_glance = $trans['at_a_glance'] ?? null;
            $why_choose_us->translateOrNew($locale)->core_values = $trans['core_values'] ?? [];

        }
        $why_choose_us->save();

        session()->flash('success', __('About updated successfully'));
        return redirect()->route('admin.why-choose-us.edit');
    }
}
