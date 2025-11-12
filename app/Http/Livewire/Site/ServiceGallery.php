<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\Services;

class ServiceGallery extends Component
{
    public $serviceId;
    public $images = [];
    public $activeIndex = 0;

    public function mount($serviceId)
    {
        $this->serviceId = $serviceId;

        $service = Services::with('images')->find($serviceId);

        if ($service) {
            $this->images = $service->images->map(function($img) {
                return $img->url; 
            })->toArray();
        } else {
            $this->images = [];
        }
    }

    public function setActive($index)
    {
        $index = (int) $index;
        if (isset($this->images[$index])) {
            $this->activeIndex = $index;
        }
    }

    public function render()
    {
        return view('livewire.site.service-gallery');
    }
}
