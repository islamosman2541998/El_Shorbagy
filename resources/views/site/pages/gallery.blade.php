
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option spad pt-5 set-bg" data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{ app()->getLocale() == 'ar' ? 'معرض الأعمال' : 'Our Gallery' }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Gallery Swiper Section -->
<section class="mini-gallery py-5">
    <div class="container">
        <div class="mini-head">
            <h3 class="mini-title">{{ app()->getLocale() == 'ar' ? 'معرض الصور' : 'Photo Gallery' }}</h3>
            <div class="mini-nav">
                <button class="mini-btn mini-prev-gallery" aria-label="Prev">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button class="mini-btn mini-next-gallery" aria-label="Next">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="swiper gallerySwiper">
            <div class="swiper-wrapper">
                @forelse ($galleries as $gallery)
                    <div class="swiper-slide">
                        <div class="gallery-card" data-image="{{ asset($gallery->image) }}" data-title="{{ $gallery->title ?? '' }}">
                            <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title ?? 'Gallery' }}">
                            <div class="gallery-body">
                                {{-- <h6>{{ $gallery->title ?? '' }}</h6> --}}
                                {{-- <span>{!! Str::limit($gallery->description ?? '', 50) !!}</span> --}}
                            </div>
                            <div class="gallery-overlay">
                                <i class="fa-solid fa-expand"></i>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">
                        {{ app()->getLocale() == 'ar' ? 'لا توجد صور' : 'No images available' }}
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</section>
<!-- Gallery Swiper Section End -->

<!-- Lightbox Modal -->
<div class="gallery-lightbox" id="galleryLightbox">
    <button class="lightbox-close" id="lightboxClose">&times;</button>
    <button class="lightbox-nav lightbox-prev" id="lightboxPrev">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
    <button class="lightbox-nav lightbox-next" id="lightboxNext">
        <i class="fa-solid fa-chevron-right"></i>
    </button>
    <div class="lightbox-content">
        <img src="" alt="" id="lightboxImage">
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>


<style>
/* ===== Gallery Section ===== */
.mini-gallery {
    background: #ffff;
    padding: 80px 0;
}

.mini-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.breadcrumb__text h2 {
    color: #936133;
   
}

.mini-title {
    color: #936133;
    font-size: 1.8rem;
    font-weight: 600;
    position: relative;
    padding-left: 15px;
}

.mini-title::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 70%;
    background: #936133;
    border-radius: 2px;
}

.mini-nav {
    display: flex;
    gap: 10px;
}

.mini-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #936133;
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mini-btn:hover {
    background: #083427;
    border-color: #083427;
    color: #ffffff;
    transform: scale(1.1);
}

.mini-btn:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

/* ===== Gallery Card ===== */
.gallery-card {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    cursor: pointer;
    height: 280px;
    background: #1a1a1a;
}

.gallery-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-card:hover img {
    transform: scale(1.1);
}

.gallery-body {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.4s ease;
}

.gallery-card:hover .gallery-body {
    transform: translateY(0);
    opacity: 1;
}

.gallery-body h6 {
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.gallery-body span {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
}

.gallery-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 60px;
    height: 60px;
    background: #083427;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.3rem;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    opacity: 0;
}

.gallery-card:hover .gallery-overlay {
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
}

/* ===== Lightbox ===== */
.gallery-lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
}

.gallery-lightbox.active {
    display: flex;
}

.lightbox-close {
    position: absolute;
    top: 25px;
    right: 25px;
    width: 50px;
    height: 50px;
    background: transparent;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    color: #fff;
    font-size: 28px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-close:hover {
    background: #d4af37;
    border-color: #d4af37;
    color: #000;
    transform: rotate(90deg);
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 55px;
    height: 55px;
    background: rgba(255,255,255,0.1);
    border: none;
    border-radius: 50%;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.lightbox-nav:hover {
    background: #d4af37;
    color: #000;
}

.lightbox-prev { left: 25px; }
.lightbox-next { right: 25px; }

.lightbox-content {
    max-width: 90%;
    max-height: 85vh;
    text-align: center;
}

.lightbox-content img {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 10px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

.lightbox-caption {
    color: #fff;
    font-size: 1.2rem;
    margin-top: 20px;
    font-weight: 500;
}

/* ===== Responsive ===== */
@media (max-width: 768px) {
    .mini-gallery {
        padding: 50px 0;
    }
    
    .mini-title {
        font-size: 1.4rem;
    }
    
    .mini-btn {
        width: 40px;
        height: 40px;
    }
    
    .gallery-card {
        height: 220px;
    }
    
    .lightbox-nav {
        width: 45px;
        height: 45px;
    }
    
    .lightbox-prev { left: 10px; }
    .lightbox-next { right: 10px; }
}

@media (max-width: 576px) {
    .gallery-card {
        height: 200px;
    }
    
    .lightbox-close {
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        font-size: 22px;
    }
}
</style>




<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gallery Swiper
    const gallerySwiper = new Swiper('.gallerySwiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.mini-next-gallery',
            prevEl: '.mini-prev-gallery',
        },
        breakpoints: {
            480: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 25,
            }
        }
    });

    // Lightbox
    const lightbox = document.getElementById('galleryLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');
    
    const galleryCards = document.querySelectorAll('.gallery-card');
    let currentIndex = 0;
    let images = [];

    // Collect images
    galleryCards.forEach((card, index) => {
        images.push({
            src: card.dataset.image,
            title: card.dataset.title
        });

        card.addEventListener('click', function() {
            currentIndex = index;
            openLightbox();
        });
    });

    function openLightbox() {
        lightboxImage.src = images[currentIndex].src;
        lightboxCaption.textContent = images[currentIndex].title;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        updateLightbox();
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateLightbox();
    }

    function updateLightbox() {
        lightboxImage.style.opacity = 0;
        setTimeout(() => {
            lightboxImage.src = images[currentIndex].src;
            lightboxCaption.textContent = images[currentIndex].title;
            lightboxImage.style.opacity = 1;
        }, 150);
    }

    // Events
    lightboxClose.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', nextImage);
    lightboxPrev.addEventListener('click', prevImage);

    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
    });
});
</script>
