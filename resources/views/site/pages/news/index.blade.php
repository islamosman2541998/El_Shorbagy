@extends('site.app')

@section('title', @$metaSetting->where('key', 'news_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'news_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'news_meta_description_' . $current_lang)->first()->value)

 @php
     $settings = \App\Settings\SettingSingleton::getInstance();
 @endphp
@section('content')
   
<!-- news Start -->
    <div class="container-fluid py-5" >
        <div class="container">
            <div class="mx-auto text-center mb-5 newDiv">
                {{-- <h6 class="text-primary text-uppercase">Our news</h6> --}}
                <h1 class="display-5">@lang('news.our_news')</h1>
            </div>
            <div class="row g-5">
                   @forelse ($news as $new)
                     <div class="col-lg-4 col-md-6" data-animate="animate__backInRight">
                         <div class="row g-0">
                             <div class="col-10">
                                 <div class="position-relative newsdiv">
                                     <img class="img-fluid w-100" src="{{ asset($new->image) }}" alt="">
                                     <div class="position-absolute start-0 bottom-0 w-100 py-3 px-4 newcontent">
                                         <h4 class="text-white">{{ $new->title ?? 'No Title' }}</h4>
                                         <span class="text-white">{!! $new->description ?? 'No Description' !!}</span>
                                         <span>{{ $new->created_at ?? 'No Date' }}</span>
                                         <a href="{{ route('site.news.show', $new->id) }}"><span>@lang('home.read_more')</span></a>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-2">
                                 <div
                                     class="h-100 d-flex flex-column align-items-center justify-content-around bg-secondary py-5">
                                     <a class="btn btn-square rounded-circle bg-white" href="{{ $settings->getItem('twitter') }}"><i
                                             class="fab fa-twitter text-secondary"></i></a>
                                     <a class="btn btn-square rounded-circle bg-white" href="{{ $settings->getItem('facebook') }}"><i
                                             class="fab fa-facebook-f text-secondary"></i></a>
                                     <a class="btn btn-square rounded-circle bg-white" href="{{ $settings->getItem('linkedin') }}"><i
                                             class="fab fa-linkedin-in text-secondary"></i></a>
                                     <a class="btn btn-square rounded-circle bg-white" href="{{ $settings->getItem('instagram') }}"><i
                                             class="fab fa-instagram text-secondary"></i></a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @empty
                     <h3>@lang('site.no_news')</h3>
                 @endforelse
                        
            </div>
        </div>
    </div>
    <!-- news End -->
@endsection

<style>
    .hero{
        margin-top: 60px !important;
    }    
</style>