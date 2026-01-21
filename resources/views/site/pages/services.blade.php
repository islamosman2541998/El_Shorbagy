    @php
        $settings = \App\Settings\SettingSingleton::getInstance();
        $show_services = (int) $settings->getHome('show_services');
    @endphp

    @if ($show_services)
        <!-- Services Start -->
        <div class="container-fluid pt-5 ">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6" data-animate="animate__fadeInLeft">
                        <div class="mb-3">
                        <h1 class="display-5 brownColor">{{ $home_page_settings->transNow->title }}</h1>
                        </div>
                                           <p class="mb-4 about_P">{!! $home_page_settings->transNow->description !!}</p>

                        <a href="{{ route('site.services.index') }}" class="btn btn-primary py-md-3 px-md-5 greenbg">@lang('admin.see_more')</a>
                    </div>
                    @forelse ($services as $service)
                        <div class="col-lg-4 col-md-6" data-animate="animate__fadeInLeft">
                            <a href="#">
                                <div class="service-item bg-light text-center p-5 P_hover ServiceDiv ">
                                    {{-- <i class="fa fa-chart-line display-1 text-primary mb-3"></i> --}}
                                    <img class="w-50 h-50" src="{{ asset($service->image) }}" alt="">
                                    <h4>{{ $service->transNow->title }}</h4>
                                    <p class="mb-0 about_P">{!! Str::limit($service->description, 50) !!}</p>
                                    <a href="{{ route('site.services.show', $service->id) }}"
                                        class="Explore align-text-bottom">@lang('home.read_more') -></a>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="">@lang('home.no_services')</p>
                    @endforelse


                </div>
            </div>
        </div>
    @endif



    <!-- Services End -->
    <style>
        .ServiceDiv img {
            color: ##D29133 !important;
        }
    </style>
