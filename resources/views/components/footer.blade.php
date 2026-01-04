    @php
        $settings = \App\Settings\SettingSingleton::getInstance();
    @endphp
    <!-- Footer Start -->
    <div class=" footer container-fluid pt-3 bg-footer bg-primary text-white foodiv">
        <div class="container">
            <div class="row gx-5 footerdiv">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-3 pt-lg-5 mb-3 animate__animated " >
                            <h4 class="text-white mb-4">@lang('admin.quicklinks')</h4>
                            <div class="d-flex flex-column justify-content-start">
                                @forelse ($footerLinks as $link)
                                    <a class="text-white mb-2"
                                        href="{{ $link->type === 'static' && $link->url ? url($link->url) : ($link->dynamic_url ? url($link->dynamic_url) : '#') }}"><i
                                            class="bi bi-arrow-right text-white me-2"></i>{{ $link->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}</a>
                                @empty

                                    <p>No links available</p>
                                @endforelse



                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-3" >
                            <h4 class="text-white mb-4">@lang('admin.popular_projects')</h4>
                            <div class="d-flex flex-column justify-content-start">
                                @forelse ($popularprojects as $popularproject)
                                    <a class="text-white mb-2" href="#"><i
                                            class="bi bi-arrow-right text-white me-2"></i>
                                        {{ $popularproject->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}</a>
                                @empty
                                    <p>No projects available</p>
                                @endforelse


                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-3" >
                            <h4 class="text-white mb-4">@lang('admin.get_in_touch')</h4>
                            <div class="d-flex footer-social mb-2">
                                <i class="bi bi-geo-alt text-white me-2"></i>
                                <p class="text-white mb-0">{{ $settings->getItem('address') }}</p>
                            </div>
                            <div class="d-flex footer-social mb-2">
                                <i class="bi bi-envelope-open text-white me-2"></i>
                                <p class="text-white mb-0">{{ $settings->getItem('email') }}</p>
                            </div>
                            <div class="d-flex footer-social mb-2">
                                <i class="bi bi-telephone text-white me-2"></i>
                                <p class="text-white mb-0">{{ $settings->getItem('mobile') }}</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-secondary btn-square rounded-circle me-2"
                                    href="{{ $settings->getItem('twitter') }}"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle me-2"
                                    href="{{ $settings->getItem('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle me-2"
                                    href="{{ $settings->getItem('linkedin') }}"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle me-2"
                                    href="{{ $settings->getItem('instagram') }}"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-lg-n5" >
                    <div
                        class="d-flex flex-column align-items-center justify-content-center text-center bg-secondary p-5">
                        <!-- <h4 class="greenColor">El shorbagy Oasis</h4> -->
                        <div class="mx-auto footer-logo">
                            <a href="index.html" class="navbar-brand  mx-auto w-25 h-25">
                                <img src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}"
                                    class="imglogo">
                            </a>
                        </div>

                        <p class="pt-3">{{ $settings->getItem('footer_description') }} </p>
                        <a href="{{ route('site.about-us') }}"
                            class="btn btn-primary py-md-3 px-md-5 me-3">@lang('admin.about-us')</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    <!-- wp icon -->
    <a href="https://wa.me/2{{ $settings->getItem('whatsapp') }}" class="whatsapp-float" target="_blank"
        aria-label="Chat on WhatsApp">
        <i class="bi bi-whatsapp mt-3 "></i>
    </a>
    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>
    <style>
        @media (max-width: 767px) {
            .footer {
                margin-top: 35px !important;
            }

        }

        [dir=rtl] .footer-social {
            gap: 15px !important;
        }

        .bi-whatsapp::before {
            content: "\f618";
            margin-top: 13px !important;
        }
    </style>
