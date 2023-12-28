@extends('layout.main')
@section('title', __('front/contact.page_title'))
@section('content')
    @include('layout.breadcrumb')
    @include('layout.contact', ['half' => false])
    <div class="maps-area">
        <div class="google-maps">
            <iframe src="{{ config('setting.contact.map') }}"></iframe>
        </div>
    </div>
@endsection
