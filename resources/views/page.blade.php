@extends('layout.main')
@section('title', $page->title)
@section('content')
    @include('layout.breadcrumb')
    <div class="site-main bg-white">
        <section class="prt-row">
            <div class="container">
                {!! $page->description !!}
            </div>
        </section>
    </div>
@endsection
