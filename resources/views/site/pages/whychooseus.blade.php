   @php
    $trans = $whyus->transNow ?? $whyus->translate(app()->getLocale());
    $coreRaw = $trans->core_values ?? [];

    if (is_string($coreRaw)) {
        $core = json_decode($coreRaw, true) ?: [];
    } else {
        $core = $coreRaw;
    }

    $c1 = $core[0] ?? ['title' => null, 'description' => null];
    $c2 = $core[1] ?? ['title' => null, 'description' => null];
    $c3 = $core[2] ?? ['title' => null, 'description' => null];
    $c4 = $core[3] ?? ['title' => null, 'description' => null];
@endphp
   
   <!-- Features Start -->
    <div class="container-fluid greenbgwithouthover feature  pb-lg-0 my-5">
        <div class="container py-5 pb-lg-0">
            <div class="mx-auto text-center mb-3 pb-2">
                <h1 class="display-5 text-white">{{ $whyus->transNow->title ?? 'About Us' }}</h1>
            </div>

            <div class="row g-5">
                <div class="col-lg-3">
                    <div class="text-white mb-5" data-animate="animate__flipInY">
                        <div
                            class="brownbgwithouthover featureDiv rounded-pill d-flex align-items-center justify-content-center mb-3">
                            <i class="fa fa-chart-line icn"></i>
                        </div>
                        <h4 class="text-white">{{ $c1['title'] ?? '—' }}</h4>
                        <p class="mb-0">{{ $c1['description'] ?? '—' }}</p>
                    </div>
                    <div class="text-white" data-animate="animate__flipInY">
                        <div
                            class="brownbgwithouthover featureDiv rounded-pill d-flex align-items-center justify-content-center mb-3">
                            <i class="fa fa-tractor icn"></i>

                        </div>
                        <h4 class="text-white">{{ $c2['title'] ?? '—' }}</h4>
                        <p class="mb-0">{{ $c2['description'] ?? '—' }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-block bg-white h-100 text-center p-5 pb-lg-0">
                        <p class="about_P">{!!  $whyus->transNow->description  !!}
                        </p>
                        <img class="img-fluid chooseImg" src="{{ asset('storage/' . $whyus->image) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="text-white mb-5" data-animate="animate__flipInY">
                        <div
                            class="brownbgwithouthover featureDiv rounded-pill d-flex align-items-center justify-content-center mb-3">
                            <i class="fa fa-file-alt icn"></i>
                        </div>
                        <h4 class="text-white">{{ $c3['title'] ?? '—' }}</h4>
                        <p class="mb-0">{{ $c3['description'] ?? '—' }}</p>
                    </div>
                    <div class="text-white" data-animate="animate__flipInY">
                        <div
                            class="brownbgwithouthover featureDiv rounded-pill d-flex align-items-center justify-content-center mb-3">
                            <i class="fa fa-headset icn"></i>
                        </div>

                        <h4 class="text-white">{{ $c4['title'] ?? '—' }}</h4>
                        <p class="mb-0">{{ $c4['description'] ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Start -->