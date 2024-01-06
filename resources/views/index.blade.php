@extends('layout.main')
@section('content')
    @if ($slider->count() > 0)
        @include('layout.slider')
    @endif
    <div class="site-main">

        @include('layout.about')

        @include('layout.product')

        @include('layout.counter')

        @include('layout.video')

        @include('layout.blog')

        @include('layout.reference')

        {{-- @include('layout.broken') --}}
        {{-- @include('layout.testimonial') --}}
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/revolution/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/rs6.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/slider.js') }}"></script>
@endsection
