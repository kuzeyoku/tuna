@extends('layout.main')
@section('title', __('front/product.txt1'))
@section('content')
    @include('layout.breadcrumb')
    <div class="site-main bg-white">
        <section class="prt-row blog-section-01 clearfix">
            <div class="container">
                <div class="row row-equal-height">
                    @foreach ($products as $product)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            <div class="featured-imagebox featured-imagebox-post style1">
                                <div class="featured-thumbnail">
                                    <a href="{{ $product->getImageUrl() }}"><img class="img-fluid"
                                            src="{{ $product->getImageUrl() }}" alt="image" width="740"
                                            height="500"></a>
                                </div>
                                <div class="featured-content">
                                    <div class="featured-title">
                                        <h3><a href="{{ $product->getUrl() }}">{{ $product->getTitle() }}</a></h3>
                                    </div>
                                    <div class="featured-desc">
                                        {{ $product->getShortDescription(100) }}
                                    </div>
                                    <div>
                                        <a class="prt-btn btn-inline prt-icon-btn-right prt-btn-size-md btn-underline"
                                            href="{{ $product->getUrl() }}">{{ __('front/product.txt2') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
