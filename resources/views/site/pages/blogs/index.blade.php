@extends('site.app')

@section('title', @$metaSetting->where('key', 'blogs_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'blogs_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'blogs_meta_description_' . $current_lang)->first()->value)


@section('content')
    <!-- Blog Start -->
    <div class="container py-5">
        <div class="row g-5">
            <!-- Blog list only (no sidebar) -->

            <h2 class="title text-center pt-3">@lang('admin.blogs')</h2>

            <div class="col-12">
                <div class="row g-5">


                    @forelse ($blogs as $blog)
                        <div class="col-12 col-sm-6 col-lg-4" data-animate="animate__fadeInLeft">
                            <div class="blog-item position-relative overflow-hidden">
                                <img class="img-fluid blogImg" src="{{ asset($blog->pathInView()) }}" alt="">
                                <a class="blog-overlay" href="{{ route('site.site.blogs.show', $blog->id) }}">
                                    <h4 class="text-white">{{ $blog->title }}</h4>
                                    <span class="text-white fw-bold">{{ $blog->created_at }}</span>
                                </a>
                            </div>
                        </div>

                    @empty
                        <h3>@lang('blogs.no_blogs')</h3>
                    @endforelse




                    {{-- <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-lg justify-content-center m-0">
                                <li class="page-item disabled">
                                    <a class="page-link rounded-0" href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link rounded-0" href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
