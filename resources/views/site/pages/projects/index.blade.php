@extends('site.app')

@section('title', @$metaSetting->where('key', 'news_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'news_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'news_meta_description_' . $current_lang)->first()->value)

@php
    $settings = \App\Settings\SettingSingleton::getInstance();
@endphp
@section('content')
    <!-- Products Start -->
    <section class="projects-alt">
        <div class="container">
            <div class="projects-alt__head">
                {{-- <h6 class="eyebrow">Projects</h6> --}}
                <h2 class="title">@lang('admin.Projects')</h2>
                <p class="subtitle">@lang('admin.projects_des')</p>
            </div>

            <div class="news-list">
                <!-- Item -->
                @forelse ($projects as $project)
                 

                    <article class="news-item" data-animate="animate__fadeInUp">
                        <div class="row g-0 align-items-stretch">
                            <!-- Image -->
                            <div class="col-lg-5 newsImages">
                                <a href="#" class="news-media">
                                    <img src="{{ asset($project->image) }}" class="img-fluid" alt="Irrigation Systems">
                                </a>
                            </div>

                            <!-- Content -->
                            <div class="col-lg-7">
                                <div class="news-body">
                                    <h3 class="news-title greenColor">
                                        <p>{{ @$project->title }}</p>
                                    </h3>

                                    <p class="news-excerpt greenColor">
                                       {!! $project->description !!} </p>


                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <p>No projects available</p>
                @endforelse
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $projects->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
            {{-- <div class="seemoreBtn">
                <a href="./Investment.html" class="btn btn-primary py-md-3 px-md-5 greenbg">See more</a>
            </div> --}}
        </div>
    </section>

    <!-- Products End -->




    <!-- our-partner -->
    @include('site.pages.our-partner')
<!-- WhatsApp Popup Modal -->
<div class="modal fade" id="whatsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" style="border-radius:16px; overflow:hidden;">
      
     

      <div class="modal-body pt-2">
      <i class="bi bi-whatsapp wp_icon "></i>

        <a class="btn svc-btn w-100 py-2" 
        style="margin: 0.5rem 0; "
           target="_blank"
           href="https://wa.me/2{{ $settings->getItem('whatsapp') }}">
              @lang('site.chat_on_whatsapp')
        </a>

     
      </div>

    </div>
  </div>
</div>

@endsection

<style>
    .hero {
        margin-top: 60px !important;
    }
</style>
