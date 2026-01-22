@extends('site.app')

@section('title', @$metaSetting->where('key', 'about_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'about_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'about_meta_description_' . $current_lang)->first()->value)

@section('content')
   <!-- About -->
   <div class="page_about">
        <!-- About Start -->
    <div class="container-fluid about  ">
        <div class="container ">
            <div class="row gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0" data-animate="animate__fadeInLeft">
                    <div class="d-flex  border border-5 borderprimary border-bottom-0 pt-4 ceoImg">
                        <img class="img-fluid mt-auto mx-auto ceo" src="{{ asset('storage/' . $about_us->image) }}" >
                    </div>
                </div>
                <div class="col-lg-6 pb-5 " data-animate="animate__fadeInRight">
                    <div class="mb-3 pb-2">
                        {{-- <h6 class=" text-uppercase greenColor">{{ $about_us->transNow->subtitle ?? 'El shorbagy ' }}</h6> --}}
                        <h1 class="display-5 brownColor">{{ $about_us->transNow->title ?? 'About Us' }}</h1>
                    </div>
                    <p class="mb-4 about_P">{!! $about_us->transNow->description ?? 'No description available' !!}</p>
                  {{-- <a href="{{ route('site.about-us') }}" class="btn btn-primary py-md-3 px-md-5 greenbg">@lang('admin.see_more')</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

   </div>

    
   <!-- Gallery -->
    @include('site.pages.gallery')

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
    .swiper-wrapper{
      height: 30% !important; 
    }
</style>