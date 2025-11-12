<div class="service-gallery">
    <div class="main-image mb-3 text-center">
        @if(count($images) && isset($images[$activeIndex]))
            <img src="{{ asset($images[$activeIndex]) }}" alt="service image" class="img-fluid main-display" style="max-height:500px; width:100%; object-fit:cover; border-radius:10px;">
        @else
            <img src="{{ asset('attachments/no_image/no_image.png') }}" alt="no image" class="img-fluid main-display" style="max-height:500px; width:100%; object-fit:cover; border-radius:10px;">
        @endif
    </div>

    <div class="thumb-gallery d-flex gap-2 flex-wrap justify-content-start">
        @foreach($images as $i => $img)
            <button type="button"
                    wire:click="setActive({{ $i }})"
                    class="thumb-btn p-0 border-0 bg-transparent"
                    style="cursor:pointer;">
                <img src="{{ asset($img) }}" alt="thumb-{{ $i }}"
                     class="img-thumbnail {{ $i === $activeIndex ? 'thumb-active' : '' }}"
                     style="width:90px; height:90px; object-fit:cover; border-radius:8px;">
            </button>
        @endforeach
    </div>
</div>

<style>
    .thumb-btn:focus { outline: none; }
    .img-thumbnail.thumb-active {
        box-shadow: 0 0 0 3px rgba(96, 209, 175, 0.25); 
        transform: scale(1.03);
        transition: transform .15s ease;
    }
    .img-thumbnail { transition: transform .12s ease, box-shadow .12s ease; }
    .img-thumbnail:hover { transform: scale(1.02); }
</style>
