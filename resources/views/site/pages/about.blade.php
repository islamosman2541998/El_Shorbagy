@php
    $settings = \App\Settings\SettingSingleton::getInstance();
    $show_about_us = (int) $settings->getHome('show_about_us');
@endphp

<!-- ABOUT US -->
@if ($show_about_us)
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
                    <p class="mb-4 about_P">{!! $about_us->transNow->sub_description ?? 'No description available' !!}</p>
                  <a href="{{ route('site.about-us') }}" class="btn btn-primary py-md-3 px-md-5 greenbg">@lang('admin.see_more')</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endif
