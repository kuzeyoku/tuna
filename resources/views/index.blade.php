@extends('layout.main')
@section('content')
    @if ($slider->count() > 0)
        @include('layout.slider')
    @endif
    <div class="site-main">

        @include('layout.about')

        @include('layout.product')

        @include('layout.counter')

        @include('layout.broken')

        @include('layout.testimonial')

        @include('layout.reference')

        @include('layout.video')

        @include('layout.blog')

    </div>
@endsection
