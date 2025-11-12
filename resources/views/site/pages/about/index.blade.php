@extends('site.app')

@section('title', @$metaSetting->where('key', 'about_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'about_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'about_meta_description_' . $current_lang)->first()->value)

@section('content')
   <!-- About -->
   <div class="page_about">
    @include('site.pages.about')

   </div>

    
   <!-- statistics -->
    @include('site.pages.statistics')

     <!-- ============== VISION & MISSION SECTION ============== -->
<section class="vision-mission">
  <div class="container">
    <div class="section-head">
      {{-- <h6 class="eyebrow">Our Direction</h6> --}}
      <h2 class="title">@lang('about.Vision_Mission')</h2>
      {{-- <p class="subtitle">We aim to build a sustainable agricultural future through innovation, expertise, and trust.</p> --}}
    </div>

    <div class="vm-grid">
      <!-- Vision -->
      <div class="vm-card" data-animate="animate__rotateInDownLeft">
        <div class="vm-icon">
          <i class="fa-solid fa-eye"></i>
        </div>
        <h3 class="vm-title">@lang('about.vision')</h3>
        <p class="vm-text">
         {!! $about_us->transNow->vision ?? 'No description available' !!}
        </p>
      </div>

      <!-- Mission -->
      <div class="vm-card" data-animate="animate__rotateInDownLeft">
        <div class="vm-icon">
          <i class="fa-solid fa-seedling"></i>
        </div>
        <h3 class="vm-title">@lang('about.mission')</h3>
        <p class="vm-text">
         {!! $about_us->transNow->mission ?? 'No description available' !!}
        </p>
      </div>
    </div>
  </div>
</section>
@endsection

<style>
    .page_about{
        margin-top: 70px !important;
    }
</style>