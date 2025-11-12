@extends('site.app')

@section('title', @$news->meta_title  )
@section('meta_key', @$news->meta_key )
@section('meta_description', @$news->meta_description )


@section('content')
<!-- ============ Blog Section (Palm Farming Article) ============ -->
<section class="blog-single">
  <div class="container" data-animate="animate__fadeInLeft">
    <div class="blog-hero">
      <h1 class="blog-title">{{ $news->title }}</h1>
      <p class="blog-meta">{{ $news->created_at }}</p>
    </div>

    <figure class="cover">
      <img src="{{ asset($news->image) }}" class="blogImg" alt="Palm Farming in Egypt">
    </figure>

    <article class="content">


      <h3>{!! $news->description !!}</h3>

    
    </article>
  </div>
</section>
@endsection
<style>
    .blog-page{
        margin-top: 140px;
    }
 .hero{
        margin-top: 70px !important;
    }
</style>