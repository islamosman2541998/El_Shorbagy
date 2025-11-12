{{-- Reviews --}}

@php
    $settings = \App\Settings\SettingSingleton::getInstance();
    $show_reviews = (int) $settings->getHome('show_reviews');
@endphp
@if ($show_reviews)
    <!-- Testimonial Start -->
    <section class="testi">
        <div class="container">
            <div class="testi-head">
                {{-- <h6 class="eyebrow">Testimonials</h6> --}}
                <h2 class="title">What Our Clients Say</h2>
            </div>
            <div class="swiper ReviewSlider">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    @forelse ($reviews as $review)
                        <div class="swiper-slide">
                            <article class="testi-card " >
                                <div class="testi-quote"><i class="fa-solid fa-quote-left"></i></div>
                                <p class="testi-text">
                                   {!! Str::limit($review->description, 100) !!}
                                </p>
                                <div class="testi-meta">
                                    <div class="testi-id">
                                        {{-- <span class="testi-badge">A</span> --}}
                                        <div>
                                            <div class="testi-name">{{ $review->customer_name }}</div>
                                            <div class="testi-role">Investor</div>
                                        </div>
                                    </div>
                                    <div class="testi-stars" aria-label="5 stars">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </article>
                        </div>


                    @empty
                        <p>{{ app()->getLocale() == 'ar' ? 'لا يوجد تقييمات متاحة' : 'No reviews available' }}</p>
                    @endforelse


                </div>
            </div>

        </div>
    </section>
    <!-- Testimonial End -->
@endif
<script>
window.addEventListener('load', function () {
    if (typeof Swiper === 'undefined') {
        return;
    }

    const bannerEl = document.querySelector('.banner');
    if (bannerEl) {
        new Swiper(bannerEl, {
            loop: true,
            autoplay: { delay: 2000, disableOnInteraction: false },
            navigation: {
                nextEl: ".banner-button-next",
                prevEl: ".banner-button-prev",
            },
            pagination: { el: '.swiper-pagination', clickable: true },
        });
    }

  
    const reviewEl = document.querySelector('.ReviewSlider');
    if (reviewEl) {
        const slidesCount = reviewEl.querySelectorAll('.swiper-slide').length;

       
        const currentWidth = window.innerWidth;
        let perView = 1;
        if (currentWidth >= 1024) perView = 2;
        else if (currentWidth >= 768) perView = 2;
        else perView = 1;

        const shouldLoop = slidesCount > perView;

        const swiperReview = new Swiper(reviewEl, {
            loop: shouldLoop,
            autoplay: { delay: 2000, disableOnInteraction: false },
            breakpoints: {
                320: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 2, spaceBetween: 10 },
            },
        });

        setTimeout(function () {
            swiperReview.update();
        }, 200);
    }
});

</script>