@extends('layout.main')
@section('title', $galery->title)
@section('content')
    @include('layout.breadcrumb')
    <div class="site-main bg-white">
        <div id="sidebar" class="prt-row sidebar prt-sidebar-left clearfix">
            <div class="container">
                <div class="position-relative">
                    <div class="border-rad_10" data-aos="fade-up" data-aos-duration="1500">
                        <img class="img-fluid w-100" src="{{ $galery->image_url }}" alt="image">
                    </div>
                </div>
                <div class="prt-service-single-content-area mt-50">
                    <div class="prt-service-description">
                        {!! $galery->description !!}
                    </div>
                </div>
                <div class="row">
                    @foreach ($galery->images as $image)
                        <div class="col-lg-6">
                            <img class="img-fluid w-100" src="{{ $image->image_url }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
