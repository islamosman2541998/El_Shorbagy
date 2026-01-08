@extends('site.app')

@section('title', @$blog->transNow->meta_title  )
@section('meta_key', @$blog->transNow->meta_key )
@section('meta_description', @$blog->transNow->meta_description )


@section('content')
<section class="blog-single">
  <div class="container" data-animate="animate__fadeInLeft">
    <div class="blog-hero">
      <h1 class="blog-title">{{ @$blog->transNow->title }}</h1>
      {{-- <p class="blog-meta">{{ @$blog->created_at }}</p> --}}
    </div>

    <figure class="cover">
      <img src="{{ asset($blog->pathInView()) }}" class="blogImg" alt="Palm Farming in Egypt">
    </figure>

    <article class="content">
      <p>{!! @$blog->transNow->description !!}</p>
     
    </article>
  </div>
</section>
<section class="mini-related py-4">
  <div class="container">
    <div class="mini-head">
      <h3 class="mini-title">مقالات أخرى</h3>

      <div class="mini-nav">
        <button class="mini-btn mini-prev" aria-label="Prev">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="mini-btn mini-next" aria-label="Next">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
    </div>

    <div class="swiper miniBlogsSwiper">
      <div class="swiper-wrapper">

    

        @forelse ($blogs as $blog)
           <div class="swiper-slide">
          <a class="mini-card" href="{{ route('site.site.blogs.show', $blog->id) }}">
            <img src="{{ asset($blog->pathInView()) }}" alt="{{ $blog->transNow->title }}">
            <div class="mini-body">
              <h6>{{ $blog->transNow->title }}</h6>
              {{-- <span>{{ $blog->created_at }}</span> --}}
            </div>
          </a>
        </div>
        @empty
        <p>{{ app()->getLocale() == 'ar' ? 'لا توجد مقالات أخرى' : 'No other articles' }}</p>
        @endforelse
       

      
       
      </div>
    </div>
  </div>
</section>

@endsection
