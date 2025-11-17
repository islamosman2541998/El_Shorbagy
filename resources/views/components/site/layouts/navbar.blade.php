@php
    $settings = \App\Settings\SettingSingleton::getInstance();
    $show_slider = (int) $settings->getHome('show_slider');

@endphp

<!-- Header Section Begin -->
<!-- Topbar Start -->
<div class="container-fluid px-5 d-none d-lg-block">
    <div class="row gx-5 py-3 align-items-center">
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-start">
                <i class="bi bi-phone-vibrate fs-1  me-2 greenColor"></i>
                <h2 class="mb-0 fontsize">
                    {{ $settings->getItem(val: 'mobile') }}</h2>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="d-flex align-items-center justify-content-center">
                <a href="index.html" class="navbar-brand ms-lg-5">
                    <h1 class="m-0 display-4 greenColor"><span
                            class="brownColor">{{ $settings->getItem(val: 'site_name') }} </span>
                        {{ $settings->getItem(val: 'site_name_lower') }}</h1>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="d-flex align-items-center justify-content-end">
                <a class="btn btn-primary btn-square rounded-circle me-2 greenbg"
                    href="{{ $settings->getItem(val: 'twitter') }}"><i class="fab fa-twitter mt-1"></i></a>
                <a class="btn btn-primary btn-square rounded-circle me-2 greenbg"
                    href="{{ $settings->getItem(val: 'facebook') }}"><i class="fab fa-facebook-f mt-1"></i></a>
                <a class="btn btn-primary btn-square rounded-circle me-2 greenbg"
                    href="{{ $settings->getItem(val: 'linkedin') }}"><i class="fab fa-linkedin-in mt-1"></i></a>
                <a class="btn btn-primary btn-square rounded-circle greenbg  me-2"
                    href="{{ $settings->getItem(val: 'instagram') }}"><i class="fab fa-instagram mt-1  "></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark  py-3 px-lg-5 greenbgwithouthover">
    <a href="{{ route('site.home') }}" class="navbar-brand d-flex w-25 h-25">
        <img src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}" class="imglogo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse navvv" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-0">
        
            @php
                $items = Cache::get('menus');
                if ($items == null) {
                    $items = Cache::rememberForever('menus', function () {
                        return App\Models\Menue::with('trans')->orderBy('sort', 'ASC')->main()->active()->get();
                    });
                }
            @endphp
            @include('site.layouts.menuItem')
            <div class="lang-switch d-flex d-lg-none mt-3">
                @foreach ($locals as $lang)
                    @php
                        $url = LaravelLocalization::getLocalizedURL($lang);
                        $isActive = app()->getLocale() === $lang;
                    @endphp
                    <a href="{{ $url }}"
                        class="text-white d-inline-flex align-items-center me-3 {{ $isActive ? 'fw-bold text-decoration-underline' : '' }}"
                        rel="alternate" hreflang="{{ $lang }}">
                        @if ($lang == 'en')
                            <i class="fa-solid fa-globe me-1"></i>
                            English
                        @else
                            <i class="fa-solid fa-language me-1"></i>
                            عربي
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="lang-switch d-flex align-items-center ms-lg-3">
        @foreach ($locals as $lang)
            @php
                $url = LaravelLocalization::getLocalizedURL($lang);
                $isActive = app()->getLocale() === $lang;
            @endphp

            <a href="{{ $url }}"
                class="text-white d-inline-flex align-items-center me-3 {{ $isActive ? 'fw-bold text-decoration-underline' : '' }}" 
                rel="alternate" hreflang="{{ $lang }}"> 
                @if ($lang == 'en') 
                    <i class="fa-solid fa-globe me-1"></i>
                    English
                @else
                    <i class="fa-solid fa-language me-1"></i>
                    عربي
                @endif
            </a>
        @endforeach
    </div>

</nav>
<!-- Navbar End -->

<style>
@media (min-width: 993px) and (max-width: 1024px) {
  .navbar-collapse .navvv {

    margin-left: 0 !important;
  }
}
    .navbar .d-flex a {
        z-index: 10000 !important;
    }
</style>
