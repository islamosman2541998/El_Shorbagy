<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Gallery;
use App\Models\Slider as ModelsSlider;

class Slider extends Component
{
    public $slides;

    public function __construct()
    {
       $this->slides = ModelsSlider::active()
        ->orderBy('sort', 'ASC')
        ->get();
    }

    public function render()
    {
        return view('components.slider');
    }
}
