@extends('site.app')

@section('title', @$metaSetting->where('key', 'contact_us_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'contact_us_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'contact_us_meta_description_' .
    $current_lang)->first()->value)

@php
    $settings = \App\Settings\SettingSingleton::getInstance();
@endphp

@section('content')

    <div class="container-fluid1 py-5">
        <div class="container">
            <div class="mx-auto text-center mb-5 contactDiv">
                {{-- <h6 class="text-primary text-uppercase">Contact Us</h6> --}}
                {{-- <h1 class="display-5" style="    padding: 0 6%;">@lang('admin.contact-us')</h1> --}}
            </div>
            <div class="row g-0">
                <div class="col-lg-7">
                    @livewire('site.contact-form')

                </div>
                <div class="col-lg-5">
                    <div class="bg-secondary h-100 p-5" data-animate="animate__fadeInRight">
                        <h2 class="text-white mb-4">@lang('admin.get_in_touch')</h2>
                        <div class="d-flex contact-social mb-4">
                            <div
                                class="bg-primary rounded-circle d-flex align-items-center justify-content-center contactform1">
                                <i class="bi bi-geo-alt fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">@lang('admin.address')</h5>
                                <span class="text-white">{{ $settings->getItem('address') }}</span>
                            </div>
                        </div>
                        <div class="d-flex contact-social mb-4">
                            <div
                                class="bg-primary rounded-circle d-flex align-items-center justify-content-center contactform1">
                                <i class="bi bi-envelope-open fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">@lang('admin.email')</h5>
                                <span class="text-white">{{ $settings->getItem('email') }}</span>
                            </div>
                        </div>
                        <div class="d-flex contact-social mb-4">
                            <div
                                class="bg-primary rounded-circle d-flex align-items-center justify-content-center contactform">
                                <i class="bi bi-phone-vibrate fs-4 text-white"></i>
                            </div>
                            <div class="ps-3">
                                <h5 class="text-white">@lang('admin.phone')</h5>
                                <span class="text-white">
                                    {{ $settings->getItem('mobile') }}</span>
                            </div>
                        </div>
                        <div class="d-flex contact-social">
                            
                            <div
                                class="bg-primary rounded-circle d-flex align-items-center justify-content-center contactform">
                                <a href="https://wa.me/2{{ $settings->getItem('whatsapp') }}" target="_blank">
                                    <i class="bi bi-whatsapp fs-4 text-white"></i>
                                </a>
                            </div>
                            <div class="ps-3">
                                <a href="https://wa.me/2{{ $settings->getItem('whatsapp') }}" target="_blank">
                                     <h5 class="text-white">@lang('admin.whatsapp')</h5>
                                <span class="text-white">
                                    {{ $settings->getItem('whatsapp') }}</span>
                                </a>
                               
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <div class="map" data-animate="animate__fadeInLeft">
        <iframe
            src="{{ $settings->getItem('maps') }}"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
<style>
    [dir=rtl] .contact-social {
        gap: 15px !important;
    }
   .contact-social .bi-whatsapp::before {
    content: "\f618";
    margin-top: 2px !important;
}
</style>
