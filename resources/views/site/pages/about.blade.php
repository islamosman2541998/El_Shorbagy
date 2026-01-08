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
                    <p class="mb-4 about_P">{!! $about_us->transNow->description ?? 'No description available' !!}</p>
                    {{-- <div class="row gx-5 gy-4">
                        <div class="col-sm-6">
                            <i class="fa fa-seedling display-1 brownColor"></i>
                            <h4 class="greenColor">Smart Farming & Resource Efficiency</h4>
                            <p class="mb-0 about_P">We use modern irrigation and monitoring practices to boost yields
                                while reducing water and energy waste—without compromising quality.</p>
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-award display-1 brownColor"></i>
                            <h4 class="greenColor">ATrusted Expertise & Proven Results</h4>
                            <p class="mb-0 about_P">Precise technical management, transparent follow-ups, and regular
                                performance reports—so you can make confident, data-backed investment decisions.</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endif
