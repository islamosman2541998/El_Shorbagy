@extends('site.app')

@section('title', @$blog->transNow->meta_title  )
@section('meta_key', @$blog->transNow->meta_key )
@section('meta_description', @$blog->transNow->meta_description )


@section('content')
<section class="blog-single">
  <div class="container" data-animate="animate__fadeInLeft">
    <div class="blog-hero">
      <h1 class="blog-title">{{ @$blog->transNow->title }}</h1>
      <p class="blog-meta">{{ @$blog->created_at }}</p>
    </div>

    <figure class="cover">
      <img src="{{ asset($blog->pathInView()) }}" class="blogImg" alt="Palm Farming in Egypt">
    </figure>

    <article class="content">
      <p>{!! @$blog->transNow->description !!}</p>
     
    </article>
  </div>
</section>
@endsection
