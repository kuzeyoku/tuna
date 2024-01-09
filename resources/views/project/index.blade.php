@extends('layout.main')
@section('title', __('front/project.txt1'))
@section('content')
    @include('layout.breadcrumb')
    <div class="site-main bg-white">
        <section class="prt-row blog-section-01 clearfix">
            <div class="container">
                <div class="row row-equal-height">
                    @foreach ($projects as $project)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                            <div class="featured-imagebox featured-imagebox-post style1">
                                <div class="featured-thumbnail">
                                    <a href="{{ $project->getImageUrl() }}"><img class="img-fluid"
                                            src="{{ $project->getImageUrl() }}" alt="image" width="740"
                                            height="500"></a>
                                </div>
                                <div class="featured-content">
                                    <div class="featured-title">
                                        <h3><a href="{{ $project->getUrl() }}">{{ $project->getTitle() }}</a></h3>
                                    </div>
                                    <div class="featured-desc">
                                        {{ $project->getShortDescription(100) }}
                                    </div>
                                    <div>
                                        <a class="prt-btn btn-inline prt-icon-btn-right prt-btn-size-md btn-underline"
                                            href="{{ $project->getUrl() }}">{{ __('front/project.txt2') }}</a>
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
