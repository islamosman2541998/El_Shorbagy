  @php
      $settings = \App\Settings\SettingSingleton::getInstance();
      $show_statistics = (int) $settings->getHome('show_statistics');
  @endphp

  @if ($show_statistics)
  <!-- Facts Start -->
  <div class="container-fluid facts  mb-5 greenbgwithouthover">
  <div class="container py-5">
  <div class="row gx-5 gy-4">
  @forelse ($statistics as $statistic)
  <div class="col-lg-3 col-md-6" data-animate="animate__fadeInUp">
  <div class="d-flex">
  <div
  class="factsdiv rounded-circle d-flex align-items-center justify-content-center mb-3 brownbgwithouthover">
  {{-- <i class="fa fa-star fs-4 text-white"></i> --}}
  <img class="w-50 h-50" src="{{ asset($statistic->image) }}" alt="">
  </div>
  <div class="ps-4">
  <h5 class="text-white">{{ $statistic->transNow->title ?? 'About Us' }}</h5>
  <h1 class="display-5 text-white mb-0" data-toggle="counter-up">
  {{ $statistic->count ?? '12345' }}</h1>
  </div>
  </div>
  </div>
@empty
  @endforelse


  </div>
  </div>
  </div>
  <!-- Facts End -->
  @endif
