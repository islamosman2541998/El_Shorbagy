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
                {{-- <h6 class="text-primary text-uppercase">Our news</h6> --}}
                <h1 class="display-5">@lang('news.our_news')</h1>
            </div>
            <div class="news-list">
                @forelse ($news as $new)
                  

                    <article class="news-item" data-animate="animate__fadeInUp">
                        <div class="row g-0 align-items-stretch">
                            <!-- Image -->
                            <div class="col-lg-5 newsImages">
                                <a href="#" class="news-media">
                                    <img src="{{ asset($new->image) }}" class="img-fluid" alt="News" />
                                </a>
                            </div>

                            <!-- Content -->
                            <div class="col-lg-7">
                                <div class="news-body">
                                    <h3 class="news-title">
                                        {{ $new->title ?? 'No Title' }}
                                    </h3>

                                    <p class="news-excerpt">
                                        {!!  $new->description ?? 'No Description' !!} </p>
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

<style>
    .hero {
        margin-top: 60px !important;
    }
    .news-item p , .news-item h3 {
color: #263A4F !important;
    }
    .newDiv h1 {
        color: #263A4F !important;
    }
</style>
