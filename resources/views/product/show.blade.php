@extends('layout.main')
@section('title', $product->getTitle())
@section('content')
    @include('layout.breadcrumb', ['nav' => [route('product.index') => __('front/product.page_title')]])
    <div class="product-details-area default-padding">
        <div class="container">
            <div class="thumb" style="background-image: url({{ $product->getImageUrl() }})"></div>
            @if ($product->video || $product->getFeatures())
                <div class="top-info">
                    <div class="row">
                        <div class="col-lg-7 left-info">
                            <h2>{{ $product->getTitle() }}</h2>
                            <iframe width="100%" height="300" src="{{ $product->video }}"></iframe>
                        </div>
                        <div class="col-lg-5 right-info">
                            <div class="product-info">
                                <h3>{{ __('front/product.detail') }}</h3>
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach ($product->getFeatures() as $key => $value)
                                            <tr>
                                                <td><strong>{{ $key }}</strong></td>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="main-content">
                {!! $product->getDescription() !!}
                <div class="row">
                    @foreach ($product->images as $image)
                        <div class="col-lg-4">
                            <a href="{{ $image->getImageUrl() }}" class="item popup-gallery">
                                <img src="{{ $image->getImageUrl() }}" alt="{{ $product->getTitle() }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
@endsection
