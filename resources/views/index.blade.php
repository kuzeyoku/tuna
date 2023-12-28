@extends('layout.main')
@section('content')
    @include('layout.slider')

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
