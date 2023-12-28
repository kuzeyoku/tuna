@extends('layout.main')
@section('title', $product->getTitle())
@section('content')
    @include('layout.breadcrumb')
    <div class="site-main bg-white">
        <div id="sidebar" class="prt-row sidebar prt-sidebar-left clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative">
                            <div class="border-rad_10" data-aos="fade-up" data-aos-duration="1500">
                                <img class="img-fluid w-100" src="{{ $product->getImageUrl() }}" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-50">
                    <div class="col-lg-4 widget-area sidebar-left prt-sticky-column">
                        <div>
                            <aside class="widget widget-nav-menu with-title">
                                <div>
                                    <h3 class="widget-title mb-30">Project Details</h3>
                                    <ul class="project-details">
                                        @foreach ($product->getFeatures() as $key => $value)
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
                                {!! $product->getDescription() !!}
                            </div>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </div>

    </div><!--site-main end-->
@endsection
