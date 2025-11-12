{{-- <script src="{{ asset('site/js/jquery-3.3.1.min.js') }}"></script> --}}
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('site/js/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('site/js/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('site/js/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('site/js/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<script src="{{ asset('site/js/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('site/js/wow.min.js') }}"></script>

<script src="{{ asset('site/js/cdn.min.js') }}"></script>
<script src="{{ asset('site/js/main.js') }}"></script>

@stack('scripts')
@livewireScripts
