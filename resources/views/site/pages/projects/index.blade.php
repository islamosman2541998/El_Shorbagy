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

            <div class="projects-alt__grid">
                <!-- Item -->
                @forelse ($projects as $project)
                    <article class="proj-card" data-animate="animate__backInLeft">
                        <div class="icon">
                            <img class="w-50 h-50" src="{{ asset($project->image) }}" alt="">
                        </div>
                        <h3 class="proj-title">{{ @$project->title }} </h3>
                        <p class="proj-desc"> {!! Str::limit($project->description, 80) !!}</p>
                        <a href="{{ route('site.projects.show', $project->id) }}" class="proj-link">@lang('home.read_more')<i
                                class="fa-solid fa-arrow-right"></i></a>
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

    <!-- why-us -->
    @include('site.pages.whychooseus')


    <!-- ========== FAQ / Accordion ========== -->
    <section class="faq-section">
        <div class="faq-head">
            <h2 class="greenColor">@lang('home.faq')</h2>
            {{-- <p class="sub brownColor">Still have a question? We’re here to help.</p> --}}
        </div>

        <div class="faq-list" role="list">
            <!-- 1 -->
            @forelse ($faq_questions as $key => $question)
                <div class="faq-item" role="listitem">
                    <button class="faq-toggle" aria-expanded="false" aria-controls="faq-1" id="btn-faq-1">
                        <span class="faq-q">{{ $question->question }}</span>
                        <span class="faq-icon" aria-hidden="true"></span>
                    </button>
                    <div class="faq-panel" id="faq-1" role="region" aria-labelledby="btn-faq-1">
                        {{ $question->answer }}
                    </div>
                </div>
            @empty
                <p>@lang('home.no_faq')</p>
            @endforelse

        </div>
    </section>


       <!-- our-partner -->
    @include('site.pages.our-partner')

@endsection

<style>
    .hero {
        margin-top: 60px !important;
    }
</style>
