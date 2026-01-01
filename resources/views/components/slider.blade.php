@php
    $settings = \App\Settings\SettingSingleton::getInstance();
    $show_slider = (int) $settings->getHome('show_slider');

@endphp
<!-- Carousel Start -->
<div class="container-fluid p-0 ">
    <div class="swiper banner">
        <div class="swiper-wrapper">
            @forelse ($slides as $slide)
                <div class="swiper-slide {{ $loop->first ? 'active' : '' }}">
                    <img class="w-100 slide-img {{ app()->getLocale() == 'ar' ? 'flip-rtl' : '' }}"
                        src="{{ asset($slide->pathInView()) }}" alt="Image">
                    <div
                        class="carousel-caption top-0 bottom-0 start-0 end-0 d-flex flex-column align-items-center justify-content-center">
                        <div class="bgContent p-5">
                            <h4 class="text-white"> {!! $slide->transNow->description ?? 'No Description' !!}</h4>
                            <h3 class="display-1 text-white mb-md-4 header_h3">
                                {{ $slide->transNow->title ?? 'No Title' }}</h3>
                            <a href="{{ route('site.about-us') }}"
                                class="btn btn-primary py-md-3 px-md-5 me-3 lightgreen">@lang('admin.about-us')</a>
                            <a href="{{ route('site.contact-us') }}"
                                class="btn btn-secondary py-md-3 px-md-5 lightbrown">@lang('admin.contact-us')</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
        <div class="swiper-pagination"></div>
        <div class="banner-button-prev swiper-button-prev"></div>
        <div class="banner-button-next swiper-button-next"></div>
    </div>
</div>
<!-- Carousel End -->
<!-- Banner Start -->
<div class="container-fluid banner mb-5" data-animate="animate__fadeInLeft">
    <div class="container">
        <div class="row gx-0">
            <div class="col-md-6 ">
                <div class=" bg-vegetable d-flex flex-column justify-content-center p-5 bannerDiv">
                    <span class="text-white sub_desc1">{!! $slide->transNow->sub_desc1 ?? 'No Description' !!}</span>
                    <a class="text-white fw-bold" href="{{ route('site.projects.index') }}">@lang('home.read_more')<i
                            class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class=" bg-fruit d-flex flex-column justify-content-center p-5 bannerDiv">
                    <span class="text-white sub_desc2">{!! $slide->transNow->sub_desc2 ?? 'No Description' !!}</span>

                    <a class="text-white fw-bold" href="{{ route('site.projects.index') }}">@lang('home.read_more')<i
                            class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<style>
    .slide-img {
        transition: transform .25s ease;
        transform-origin: center;
    }

    .flip-rtl {
        transform: scaleX(-1);
    }

    @media (max-width: 780px) {
        .display-1 {
            font-size: 20px !important;
        }
    }


    .swiper-button-next,
    .swiper-button-prev {
        color: #60d1af !important;
    }

    .bg-fruit p {
        color: #ffffff !important;
    }
</style>
