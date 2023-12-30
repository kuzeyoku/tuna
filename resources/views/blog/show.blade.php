@extends('layout.main')
@section('title', $post->getTitle())
@section('content')
    @include('layout.breadcrumb')
    <div class="site-main bg-white">
        <div id="sidebar" class="prt-row sidebar prt-sidebar-right clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 content-area">
                        <article class="post prt-blog-single clearfix">
                            <div class="prt-post-featured-wrapper prt-featured-wrapper">
                                <div class="prt-post-featured style1">
                                    <img width="827" height="450" class="img-fluid w-100"
                                        src="{{ $post->getImageUrl() }}" alt="">
                                </div>
                            </div>
                            <div class="prt-blog-single-content">
                                <div class="prt-post-entry-header">
                                    <div class="post-meta">
                                        <span class="blog-tag">{{ $post->getCategoryTitle() }}</span>
                                        <span class="prt-meta-line date-link"><time class="entry-date published"
                                                datetime="{{ $post->updated_at }}">{{ $post->updated_at->translatedFormat('d M Y') }}</time></span>
                                    </div>
                                </div>
                                <div class="entry-content">
                                    <div class="prt-box-desc-text">
                                        <h3>{{ $post->getTitle() }} </h3>
                                        {!! $post->getDescription() !!}

                                        <div class="social-media-block">
                                            @if (count($post->getTags()) > 0)
                                                <div class="prt_tag_lists">
                                                    <span class="prt-tags-links-title">Etiketler:</span>
                                                    <span class="prt-tags-links">
                                                        @foreach ($post->getTags() as $tag)
                                                            <a rel="tag">{{ $tag }}</a>
                                                        @endforeach
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="prt-social-share-wrapper">
                                                <ul class="social-icons">
                                                    @if (config('setting.social.facebook'))
                                                        <li><a href="{{ config('setting.social.facebook') }}" rel="noopener"
                                                                aria-label="facebook"><i class="icon-facebook"></i></a></li>
                                                    @endif
                                                    @if (config('setting.social.twitter'))
                                                        <li><a href="{{ config('setting.social.twitter') }}" rel="noopener"
                                                                aria-label="twitter"><i class="icon-twitter"></i></a></li>
                                                    @endif
                                                    @if (config('setting.social.instagram'))
                                                        <li><a href="{{ config('setting.social.instagram') }}"
                                                                rel="noopener" aria-label="instagram"><i
                                                                    class="icon-instagram"></i></a></li>
                                                    @endif
                                                    @if (config('setting.social.youtube'))
                                                        <li><a href="{{ config('setting.social.youtube') }}" rel="noopener"
                                                                aria-label="youtube"><i class="icon-youtube"></i></a></li>
                                                    @endif
                                                    @if (config('setting.social.linkedin'))
                                                        <li><a href="{{ config('setting.social.linkedin') }}"
                                                                rel="noopener" aria-label="linkedin"><i
                                                                    class="icon-linkedin"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-4 widget-area sidebar-right prt-sticky-column">
                        @include('blog/sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
