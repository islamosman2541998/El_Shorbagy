@extends('site.app')

@section('title', @$news->meta_title  )
@section('meta_key', @$news->meta_key )
@section('meta_description', @$news->meta_description )

@php
    $settings = \App\Settings\SettingSingleton::getInstance();
@endphp
@section('content')
<section class="investment-details py-5">
  <div class="container">
    <div class="row align-items-center">
    
      <div class="col-lg-6 mb-4 mb-lg-0" data-animate="animate__fadeInLeft">
        <img src="{{ asset($projects->image) }}" alt="Palm Farms" class="img-fluid rounded shadow-sm investImg">
      </div>

     
      <div class="col-lg-6" data-animate="animate__fadeInRight">
        <h2 class="fw-bold text-brown mb-3">{{ $projects->title ?? __('messages.No Title') }}</h2>
        <p class="mb-3 text-muted ">
          {!!  $projects->description ?? __('messages.No Description') !!}
        </p>

        {{-- <ul class="list-unstyled mb-4">
          <!-- <li>🌴 <strong>Initial Setup:</strong> $25,000 per acre</li> -->
          <li>🌾 <strong>First Harvest:</strong> Starting from year 3</li>
          <li>💰 <strong>Expected Annual Return:</strong> 18–24% (at full maturity)</li>
          <li>📈 <strong>Full Yield:</strong> Around year 7 – up to 40 kg/tree</li>
          <li>🕒 <strong>Payback Period:</strong> 4–5 years on average</li>
        </ul> --}}

        {{-- <p class="small text-secondary fst-italic mb-4">
          *Figures are estimated and may vary based on soil type, variety, and market conditions.
        </p> --}}

        <a href="https://wa.me/2{{ $settings->getItem('whatsapp') }}" class="btn btn-success me-2">@lang('contact_us.request_contact')</a>
        <a href="{{ route('site.projects.index') }}" class="btn btn-outline-secondary backbtn">@lang('contact_us.back_to_investment')</a>
      </div>
    </div>
  </div>
</section>

    <!-- ========== FAQ / Accordion ========== -->
    <section class="faq-section">
        <div class="faq-head">
            <h2 class="greenColor">@lang('home.faq')</h2>
            {{-- <p class="sub brownColor">Still have a question? We’re here to help.</p> --}}
        </div>

        <div class="faq-list" role="list">
            <!-- 1 -->
            @forelse ($faq_questions as $key => $question)
                <div class="faq-item" role="listitem">
                    <button class="faq-toggle" aria-expanded="false" aria-controls="faq-1" id="btn-faq-1">
                        <span class="faq-q">{{ $question->question }}</span>
                        <span class="faq-icon" aria-hidden="true"></span>
                    </button>
                    <div class="faq-panel" id="faq-1" role="region" aria-labelledby="btn-faq-1">
                        {{ $question->answer }}
                    </div>
                </div>
            @empty
                <p>@lang('home.no_faq')</p>
            @endforelse

        </div>
    </section>


       <!-- our-partner -->
    @include('site.pages.our-partner')
@endsection
<style>
    .blog-page{
        margin-top: 140px;
    }
 .hero{
        margin-top: 70px !important;
    }
</style>