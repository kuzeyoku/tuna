@extends('layout.main')
@section('title', $post->title)
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
                                    <img width="827" height="450" class="img-fluid w-100" src="{{ $post->image_url }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="prt-blog-single-content">
                                <div class="prt-post-entry-header">
                                    <div class="post-meta">
                                        <span class="blog-tag">{{ $post->category_title }}</span>
                                        <span class="prt-meta-line date-link"><time class="entry-date published"
                                                datetime="{{ $post->updated_at }}">{{ $post->updated_at->translatedFormat('d M Y') }}</time></span>
                                    </div>
                                </div>
                                <div class="entry-content">
                                    <div class="prt-box-desc-text">
                                        <h3>{{ $post->title }} </h3>
                                        {!! $post->description !!}

                                        <div class="social-media-block">
                                            @if (count($post->tagsToArray) > 0)
                                                <div class="prt_tag_lists">
                                                    <span class="prt-tags-links-title">{{ __('front/blog.txt4') }}:</span>
                                                    <span class="prt-tags-links">
                                                        @foreach ($post->tagsToArray as $tag)
                                                            <a rel="tag">{{ $tag }}</a>
                                                        @endforeach
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="prt-social-share-wrapper">
                                                <ul class="social-icons">
                                                    @if (config('setting.social'))
                                                        @foreach (config('setting.social') as $key => $value)
                                                            <li>
                                                                <a href="{{ config('setting.social.' . $key) }}"
                                                                    rel="noopener" aria-label="{{ $key }}">
                                                                    <i class="icon-{{ $key }}"></i>
                                                                </a>
                                                            </li>
                                                        @endforeach
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
