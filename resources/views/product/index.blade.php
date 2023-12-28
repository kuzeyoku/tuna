@extends('layout.main')
@section('title', __('front/product.page_title'))
@section('content')
    @include('layout.breadcrumb')
    <div class="case-studies-area overflow-hidden grid-items default-padding">
        <div class="container">
            <div class="case-items-area">
                <div class="masonary">
                    <div id="portfolio-grid" class="case-items colums-2" style="position: relative; height: 1140px;">
                        @foreach ($products as $product)
                            <div class="pf-item" style="position: absolute; left: 0%; top: 0px;">
                                <div class="item">
                                    <div class="thumb">
                                        <img src="{{ $product->getImageUrl() }}" alt="{{ $product->getTitle() }}">
                                        <a href="{{ $product->getImageUrl() }}" class="item popup-gallery">
                                            @svg('fas-plus')
                                        </a>
                                    </div>
                                    <div class="info">
                                        @if ($product->category)
                                            <div class="tags">
                                                # {{ $product->category->getTitle() }}
                                            </div>
                                        @endif
                                        <h4>
                                            <a href="{{ $product->getUrl() }}">{{ $product->getTitle() }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
@endsection
