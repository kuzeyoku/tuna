@extends('layout.main')
@section('title', __('front/service.page_title'))
@section('content')
    @include('layout.breadcrumb')
    <div class="services-area default-padding">
        <div class="container">
            <div class="services-content text-center">
                <div class="row">
                    @foreach ($service as $service)
                        <div class="single-item col-lg-3 col-md-6">
                            <div class="item">
                                <img src="{{ $service->getImageUrl() }}" alt="{{ $service->getTitle() }}">
                                <h5><a class="text-nowrap" href="{{ $service->getUrl() }}">{{ $service->getTitle() }}</a>
                                </h5>
                                <p>
                                    {!! Str::limit($service->getDescription(true), 90, '...') !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="bottom-content text-center">
                    <p>
                        {{ __('front/service.offer_description') }}
                        <a href="{{ route('contact.index') }}">
                            {{ __('front/service.offer_link_title') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('layout.chose')
    @include('layout.counter')
    @include('layout.reference')
@endsection
