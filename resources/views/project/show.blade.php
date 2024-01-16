@extends('layout.main')
@section('title', $project->title)
@section('content')
    @include('layout.breadcrumb')
    <div class="site-main bg-white">
        <div id="sidebar" class="prt-row sidebar prt-sidebar-left clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative">
                            <div class="border-rad_10" data-aos="fade-up" data-aos-duration="1500">
                                <img class="img-fluid w-100" src="{{ $project->image_url }}" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-50">
                    <div class="col-lg-4 widget-area sidebar-left prt-sticky-column">
                        <div>
                            <aside class="widget widget-nav-menu with-title">
                                <div>
                                    <h3 class="widget-title mb-30">{{ __('front/project.txt3') }}</h3>
                                    <ul class="project-details">
                                        @foreach ($project->feature as $key => $value)
                                            <li>
                                                <h3>{{ $key }} : </h3>
                                                <div class="content-wrapper">{{ $value }}</div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                    <div class="col-lg-8 content-area">
                        <div class="prt-service-single-content-area">
                            <div class="prt-service-description">
                                @if ($project->model3D)
                                    <div class="mb-30">
                                        <iframe title="{{ $project->title }}" frameborder="0" allowfullscreen
                                            mozallowfullscreen="true" webkitallowfullscreen="true"
                                            allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking
                                            execution-while-out-of-viewport execution-while-not-rendered web-share
                                            src="{{ $project->model3D }}" height="400" width="100%"> </iframe>
                                    </div>
                                @endif
                                {!! $project->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
