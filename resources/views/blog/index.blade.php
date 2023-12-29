@extends('layout.main')
@section('title', __('front/blog.page_title'))
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
                                        <img width="350" height="240" class="img-fluid" src="{{ $post->getImageUrl() }}"
                                            alt="blog-img">
                                    </div>
                                </div>
                                <div class="prt-blog-classic-content">
                                    <div class="prt-post-entry-header">
                                        <header class="entry-header">
                                            <span class="blog-featured-tag">{{ $post->getCategoryTitle() }}</span>
                                            <h2 class="entry-title"><a
                                                    href="{{ $post->getUrl() }}">{{ $post->getTitle() }}</a>
                                            </h2>
                                            <p>{{ $post->getShortDescription() }}</p>
                                        </header>
                                    </div>
                                    <div class="entry-content">
                                        <div class="prt-blogbox-footer-readmore">
                                            <a class="prt-btn btn-inline prt-icon-btn-right prt-btn-size-md btn-underline"
                                                href="{{ $post->getUrl() }}">Detaylar</a>
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
                        <div>
                            <aside class="widget widget-search with-title">
                                <div class="widget-categories">
                                    <h3 class="widget-title">Kategoriler</h3>
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ $category->getUrl(\App\Enums\ModuleEnum::Blog) }}">{{ $category->getTitle() }}</a><span>{{ $category->countBlogs() }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="widget-recent-post">
                                    <h3 class="widget-title">Popüler Konular</h3>
                                    <ul class="widget-post prt-recent-post-list">
                                        @foreach ($popularPost as $post)
                                            <li>
                                                <div class="post-detail">
                                                    <span class="post-tag">{{ $post->getCategoryTitle() }}</span>
                                                    <a href="{{ $post->getUrl() }}">{{ $post->getTitle() }}</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tagcloud-widget">
                                    <h3 class="widget-title">Tags</h3>
                                    <div class="tagcloud">
                                        @foreach (\App\Models\Blog::uniqueTags() as $tag)
                                            <a class="tag-cloud-link">{{ $tag }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </div>

    </div><!--site-main end-->
@endsection
