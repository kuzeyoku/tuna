@extends('admin.layout.main')
@section('pageTitle', $product->title[app()->getLocale()])
@section('content')
    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    {{ __("admin/{$folder}.form_content") }}
                </div>
                <div class="card-body">
                    {!! $product->content[app()->getLocale()] !!}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    {{ __("admin/{$folder}.form_features") }}
                </div>
                <div class="card-body">
                    <div class="productdetails">
                        <ul class="product-bar">
                            @foreach ($product->getFeaturesList() as $key => $value)
                                <li>
                                    <h4>{{ $key }}</h4>
                                    <h6>{{ $value }}</h6>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="slider-product-details">
                        <div class="owl-carousel owl-theme product-slide owl-loaded owl-drag">


                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(-492px, 0px, 0px); transition: all 0.25s ease 0s; width: 986px;">

                                    @foreach ($product->images as $image)
                                        <div class="owl-item" style="width: 462.656px; margin-right: 30px;">
                                            <div class="slider-product">
                                                <img src="{{ uploadFolder($folder, $image->image) }}" alt="img">
                                                <h4>{{ $image->image }}</h4>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                        aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                    class="owl-next disabled"><span aria-label="Next">›</span></button></div>
                            <div class="owl-dots disabled"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('style')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/owl.carousel.min.css') }}">
    @endsection
    @section('script')
        <script src="{{ asset('assets/admin/js/owl.carousel.min.js') }}"></script>
    @endSection
