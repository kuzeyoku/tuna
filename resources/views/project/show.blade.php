@extends('layout.main')
@section('title', $project->getTitle())
@section('content')
    @include('layout.breadcrumb', ['nav' => [route('project.index') => __('front/project.page_title')]])
    <div class="project-details-area default-padding">
        <div class="container">
            <div class="thumb" style="background-image: url({{ $project->getImageUrl() }})"></div>
            @if ($project->model3D || $project->getFeatures())
                <div class="top-info">
                    <div class="row">
                        <div class="col-lg-7 left-info">
                            <h2>{{ $project->getTitle() }}</h2>
                            <iframe width="100%" height="300" src="{{ $project->model3D }}"></iframe>
                        </div>
                        <div class="col-lg-5 right-info">
                            <div class="project-info">
                                <h3>{{ __('front/project.detail') }}</h3>
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach ($project->getFeatures() as $key => $value)
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
                {!! $project->getDescription() !!}
                @if ($project->video)
                    <iframe width="100%" height="400" src="{{ $project->video }}"></iframe>
                @endif
                <div class="row">
                    @foreach ($project->images as $image)
                        <div class="col-lg-4">
                            <a href="{{ $image->getImageUrl() }}" class="item popup-gallery">
                                <img src="{{ $image->getImageUrl() }}" alt="{{ $project->getTitle() }}">
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
