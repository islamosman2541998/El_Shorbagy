 <!-- BLOG SECTION -->

 @php
     $settings = \App\Settings\SettingSingleton::getInstance();
     $show_blogs = (int) $settings->getHome('show_blogs');
 @endphp
 @if ($show_blogs)
        <!-- Blog Start -->
    <div class="container-fluid py-4 ">
        <div class="container">
            <div class="mx-auto text-center mb-5 BlogDiv">
                {{-- <h6 class="text-primary text-uppercase">Our Blog</h6> --}}
                <h1 class="display-5">@lang('blogs.latest_blogs')</h1>
            </div>
            <div class="row g-5">
                @forelse ($blogs as $blog)
                <div class="col-lg-4" data-animate="animate__backInRight">
                    <div class="blog-item position-relative overflow-hidden blogs">
                        <img class="img-fluid blogImg" src="{{ asset($blog->pathInView()) }}" alt="">
                        <a class="blog-overlay" href="./singleblog.html">
                            <h4 class="text-white">{{ $blog->title }}</h4>
                            <span class="text-white fw-bold">{{ $blog->created_at }}</span>
                            <span>@lang('home.read_more')</span>
                        </a>
                    </div>
                </div>
                     @empty
                     <h3>@lang('blogs.no_blogs')</h3>
                 @endforelse
             
                <div class="seemoreBtn">
                    <a href="{{ route('site.site.blogs.index') }}" class="btn btn-primary py-md-3 px-md-5 greenbg">@lang('admin.see_more')</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
 @endif
