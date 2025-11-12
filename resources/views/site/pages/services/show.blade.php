@extends('site.app')

{{-- @section('title', @$service->trans->where('locale',$current_lang)->first()->meta_title)
@section('meta_key', @$service->trans->where('locale',$current_lang)->first()->meta_key)
@section('meta_description', @$service->trans->where('locale',$current_lang)->first()->meta_description) --}}

@section('content')

   <!-- ========== Modern Service Details Section ========== -->
    <section class="service-modern">
        <div class="container">
            <div class="row align-items-start">
                <!-- Left Side (Image Gallery) -->
                <div class="col-lg-6" data-animate="animate__fadeInLeft">
                   @livewire('site.service-gallery', ['serviceId' => $services->id])

                </div>

                <!-- Right Side (Details) -->
                <div class="col-lg-6 ps-lg-5 mt-4 mt-lg-0" data-animate="animate__fadeInRight">
                    <h2 class="service-title">{{ $services->transNow->title }}</h2>
                    <p class="subtitle">
                        {!! $services->transNow->description !!}
                    </p>

       

                    <a href="{{ route('site.contact-us') }}" class="btn-learn svc-btn ">@lang('contact_us.request_contact')</a>
                </div>
            </div>
        </div>
    </section>
 
@endsection
