@extends('site.app')

@section('title', @$metaSetting->where('key', 'news_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'news_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'news_meta_description_' . $current_lang)->first()->value)

@php
    $settings = \App\Settings\SettingSingleton::getInstance();
@endphp

@section('content')

    <!-- news Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5 newDiv">
                <h1 class="display-5">@lang('news.our_news')</h1>
            </div>
            <div class="news-list">
                @forelse ($news as $key => $new)
                    <article class="news-item" data-animate="animate__fadeInUp">
                        <div class="row g-0 align-items-stretch">
                            <!-- Gallery Slider -->
                            <div class="col-lg-5 newsImages">
                                @if($new->images->count() > 0)
                                    <div id="newsSlider{{ $key }}" class="carousel slide" data-bs-ride="carousel">
                                        <!-- Indicators -->
                                        @if($new->images->count() > 1)
                                        <div class="carousel-indicators">
                                            @foreach($new->images as $index => $image)
                                                <button type="button" 
                                                    data-bs-target="#newsSlider{{ $key }}" 
                                                    data-bs-slide-to="{{ $index }}" 
                                                    class="{{ $index == 0 ? 'active' : '' }}"
                                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}">
                                                </button>
                                            @endforeach
                                        </div>
                                        @endif

                                        <!-- Slides -->
                                        <div class="carousel-inner">
                                            @foreach($new->images as $index => $image)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset($image->url) }}" 
                                                         class="d-block w-100 news-slider-img" 
                                                         alt="{{ $new->title }}">
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Controls -->
                                        @if($new->images->count() > 1)
                                        <button class="carousel-control-prev" type="button" 
                                            data-bs-target="#newsSlider{{ $key }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" 
                                            data-bs-target="#newsSlider{{ $key }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                        @endif
                                    </div>
                                @else
                                    <a href="#" class="news-media">
                                        <img src="{{ asset($new->image) }}" class="img-fluid" alt="{{ $new->title }}">
                                    </a>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="col-lg-7">
                                <div class="news-body">
                                    <h3 class="news-title">
                                        {{ $new->title ?? 'No Title' }}
                                    </h3>
                                    <p class="news-excerpt">
                                        {!! $new->description ?? 'No Description' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <h3>@lang('site.no_news')</h3>
                @endforelse
            </div>
        </div>
    </div>
    <!-- news End -->

@endsection

@section('style')
<style>
    .hero {
        margin-top: 60px !important;
    }
    .news-item p, .news-item h3 {
        color: #263A4F !important;
    }
    .newDiv h1 {
        color: #263A4F !important;
    }
    
    /* Slider Styles */
    .news-slider-img {
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .carousel {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .carousel:hover .carousel-control-prev,
    .carousel:hover .carousel-control-next {
        opacity: 1;
    }
    
    .carousel-control-prev {
        left: 10px;
    }
    
    .carousel-control-next {
        right: 10px;
    }
    
    .carousel-indicators {
        margin-bottom: 10px;
    }
    
    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.7);
        border: none;
    }
    
    .carousel-indicators button.active {
        background-color: #fff;
    }
</style>
@endsection