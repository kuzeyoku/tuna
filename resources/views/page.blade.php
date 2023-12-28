@extends('layout.main')
@section('title', $page->getTitle())
@section('content')
    @include('layout.breadcrumb')
    <div class="about-area center-responsive default-padding">
        <div class="container">
            {!! $page->getDescription() !!}
        </div>
    </div>
@endsection
