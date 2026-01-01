@extends('site.app')

@section('title', @$metaSetting->where('key', 'news_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'news_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'news_meta_description_' . $current_lang)->first()->value)


@section('content')
    <!-- Products Start -->
    <section class="projects-alt">
        <div class="container">
            <div class="projects-alt__head">
                {{-- <h6 class="eyebrow">Projects</h6> --}}
                <h2 class="title">@lang('admin.Projects')</h2>
                <p class="subtitle">@lang('admin.projects_des')</p>
            </div>

            <div class="news-list">
                <!-- Item -->
                @forelse ($projects as $project)
                 

                    <article class="news-item" data-animate="animate__fadeInUp">
                        <div class="row g-0 align-items-stretch">
                            <!-- Image -->
                            <div class="col-lg-5 newsImages">
                                <a href="#" class="news-media">
                                    <img src="{{ asset($project->image) }}" class="img-fluid" alt="Irrigation Systems">
                                </a>
                            </div>

                            <!-- Content -->
                            <div class="col-lg-7">
                                <div class="news-body">
                                    <h3 class="news-title">
                                        <p>{{ @$project->title }}</p>
                                    </h3>

                                    <p class="news-excerpt">
                                       {!! $project->description !!} </p>


                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <p>No projects available</p>
                @endforelse
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $projects->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
            {{-- <div class="seemoreBtn">
                <a href="./Investment.html" class="btn btn-primary py-md-3 px-md-5 greenbg">See more</a>
            </div> --}}
        </div>
    </section>

    <!-- Products End -->




    <!-- our-partner -->
    @include('site.pages.our-partner')
    <!-- WhatsApp Popup Modal -->
    <div class="modal fade" id="whatsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius:16px; overflow:hidden;">

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold wppopup">Need help?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body pt-2">
                    <p class="mb-3 text-muted">
                        Chat with us on WhatsApp for investment details, pricing, and partnerships.
                    </p>

                    <a class="btn svc-btn w-100 py-2" target="_blank"
                        href="https://wa.me/201055857775?text=Hello%20I%20want%20to%20know%20more%20about%20your%20agricultural%20projects">
                        Open WhatsApp
                    </a>

                    <small class="d-block text-center mt-3 text-muted">
                        We typically reply within minutes.
                    </small>
                </div>

            </div>
        </div>
    </div>
@endsection

<style>
    .hero {
        margin-top: 60px !important;
    }
</style>
