@extends('layout.main')
@section('title', __('front/blog.txt1'))
@section('content')
    @include('layout.breadcrumb')
    <div class="site-main bg-white">
        <div id="sidebar" class="prt-row sidebar prt-sidebar-right clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 content-area">
                        @foreach ($posts as $post)
                            <article class="post prt-blog-classic clearfix">
                                <div class="prt-post-featured-wrapper prt-featured-wrapper">
                                    <div class="prt-post-featured">
                                        <img width="350" height="240" class="img-fluid" src="{{ $post->image_url }}"
                                            alt="blog-img">
                                    </div>
                                </div>
                                <div class="prt-blog-classic-content">
                                    <div class="prt-post-entry-header">
                                        <header class="entry-header">
                                            <span class="blog-featured-tag">{{ $post->category_title }}</span>
                                            <h2 class="entry-title"><a href="{{ $post->url }}">{{ $post->title }}</a>
                                            </h2>
                                            <p>{{ $post->short_description }}</p>
                                        </header>
                                    </div>
                                    <div class="entry-content">
                                        <div class="prt-blogbox-footer-readmore">
                                            <a class="prt-btn btn-inline prt-icon-btn-right prt-btn-size-md btn-underline"
                                                href="{{ $post->url }}">{{ __('front/blog.txt2') }}</a>
                                            <span class="prt-meta-line date-link"><time class="entry-date published"
                                                    datetime="{{ $post->updated_at }}">{{ $post->updated_at->translatedFormat('d M Y') }}</time></span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        {{ $posts->render('pagination::custom') }}
                    </div>
                    <div class="col-lg-4 widget-area sidebar-right prt-sticky-column">
                        @include('blog/sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
