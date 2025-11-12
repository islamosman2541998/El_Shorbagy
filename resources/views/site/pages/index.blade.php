@extends('site.app')

@section('title', @$metaSetting->where('key', 'home_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'home_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'home_meta_description_' . $current_lang)->first()->value)


@section('content')

    <!-- Slider -->
    <x-slider />

   <!-- About -->
    @include('site.pages.about')

    
   <!-- statistics -->
    @include('site.pages.statistics')


   <!-- services -->
    @include('site.pages.services')

   <!-- why-us -->
    @include('site.pages.whychooseus')

  <!-- news -->
    @include('site.pages.news')

     <!-- Reviews -->
    <x-reviews :limit="10" />

 <!-- Blogs -->
    @include('site.pages.blogs')

    <!-- our-partner -->
    @include('site.pages.our-partner')


    
@endsection
