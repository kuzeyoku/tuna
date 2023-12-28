@extends('layout.main')
@section('title', $service->getTitle())
@section('content')
@include("layout.breadcrumb", ["nav" => [route("service.index") => __("front/service.page_title")]])
<div class="services-details-area default-padding">
    <div class="container">
        <div class="services-details-items">
            <div class="row">
                <div class="col-lg-4 services-sidebar order-last order-lg-first">
                    @if($otherServices->count() > 0)
                    <div class="single-widget services-list">
                        <h4 class="widget-title">{{ __("front/service.show_other_services") }}</h4>
                        <div class="content">
                            <ul>
                                @foreach ($otherServices as $item)
                                <li class="{{ $loop->first ? 'current-item' : '' }}"><a href="{{ route('service.show', [$item, $item->slug]) }}">{{ $item->getTitle() }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="single-widget quick-contact text-light" style="background-image: url({{ asset('assets/img/about/1.jpg') }})">
                        <div class="content">
                            <i class="fas fa-phone"></i>
                            <h4>{{ __("front/service.show_call") }}</h4>
                            <p>
                                {{ __("front/service.show_call_description") }}
                            </p>
                            <h2>{{ config('setting.contact.phone') }}</h2>
                        </div>
                    </div>
                    <!-- <div class="single-widget brochure">
                        <h4 class="widget-title">{{ __("front/service.show_brochure") }}</h4>
                        <ul>
                            <li><a href="#"><i class="fas fa-file-pdf"></i> Download Docs</a></li>
                            <li><a href="#"><i class="fas fa-file-word"></i> Company details</a></li>
                        </ul>
                    </div> -->
                </div>
                <div class="col-lg-8 services-single-content">
                    <img src="{{ $service->getImageUrl() }}" alt="{{ $service->getTitle() }}">
                    <h2>{{ $service->getTitle() }}</h2>
                    {!! trim($service->getDescription()) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
