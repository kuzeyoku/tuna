@extends('layout.main')
@section('title', __('front/blog.page_title'))
@section('content')
    @include('layout.breadcrumb')
    <div class="blog-area full-blog right-sidebar full-blog default-padding">
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    <div class="blog-content col-lg-8 col-md-12">
                        <div class="blog-item-box">
                            @foreach ($posts as $post)
                                <div class="single-item">
                                    <div class="item wow fadeInUp">
                                        <div class="thumb">
                                            <img src="{{ $post->getImageUrl() }}" alt="{{ $post->getTitle() }}">
                                        </div>
                                        <div class="info">
                                            <div class="meta">
                                                <ul>
                                                    <li>@svg('fas-calendar-alt')
                                                        {{ $post->getCreatedDate() }}
                                                    </li>
                                                    <li>@svg('fas-eye') {{ $post->view_count }}
                                                        {{ __('front/blog.view') }}
                                                    </li>
                                                    <li>@svg('fas-list-ul') {{ $post->getCategoryTitle() }}</li>
                                                </ul>
                                            </div>
                                            <h3>
                                                <a href="{{ $post->getUrl() }}">{{ $post->getTitle() }}</a>
                                            </h3>
                                            <p>
                                                {!! Str::limit(strip_tags($post->getDescription()), 160) !!}
                                            </p>
                                            <div class="bottom">
                                                <span class="font-weight-bold">
                                                    <img src="{{ asset('assets/img/teams/1.jpg') }}">
                                                    {{ $post->user->name }}
                                                </span>
                                                <a class="btn circle btn-theme effect btn-md" href="{{ $post->getUrl() }}">
                                                    {{ __('front/blog.read_more') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $posts->render('pagination::default') }}
                    </div>
                    <div class="sidebar wow fadeInLeft col-lg-4 col-md-12">
                        <aside>
                            {{-- <div class="sidebar-item search">
                                    <div class="sidebar-info">
                                        <form>
                                            <input type="text" name="text" class="form-control">
                                            <button type="submit"><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div> --}}
                            <div class="sidebar-item recent-post">
                                <div class="title">
                                    <h4>{{ __('front/blog.popular_post') }}</h4>
                                </div>
                                <ul>
                                    @foreach ($popularPost as $post)
                                        <li>
                                            <div class="thumb">
                                                <a href="{{ $post->getUrl() }}">
                                                    <img src="{{ $post->getImageUrl() }}" alt="{{ $post->getTitle() }}">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <a href="{{ $post->getUrl() }}">{{ $post->getTitle() }}</a>
                                                <div class="meta-title">
                                                    <span class="post-date">@svg('fas-calendar-alt')</i>
                                                        {{ $post->getCreatedDate() }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="sidebar-item category">
                                <div class="title">
                                    <h4>{{ __('front/blog.categories') }}</h4>
                                </div>
                                <div class="sidebar-info">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="">{{ $category->getTitle() }}
                                                    <span>({{ $category->countBlogs() }})</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-item social-sidebar">
                                <div class="title">
                                    <h4>{{ __('front/blog.follow_us') }}</h4>
                                </div>
                                <div class="sidebar-info">
                                    <ul>
                                        @if (config('setting.social.facebook'))
                                            <li class="facebook">
                                                <a href="{{ config('setting.social.facebook') }}">
                                                    @svg('fab-facebook')
                                                </a>
                                            </li>
                                        @endif
                                        @if (config('setting.social.twitter'))
                                            <li class="twitter">
                                                <a href="{{ config('setting.social.twitter') }}">
                                                    @svg('fab-twitter')
                                                </a>
                                            </li>
                                        @endif
                                        @if (config('setting.social.instagram'))
                                            <li class="instagram">
                                                <a href="{{ config('setting.social.instagram') }}">
                                                    @svg('fab-instagram')
                                                </a>
                                            </li>
                                        @endif
                                        @if (config('setting.social.linkedin'))
                                            <li class="linkedin">
                                                <a href="{{ config('setting.social.linkedin') }}">
                                                    @svg('fab-linkedin')
                                                </a>
                                            </li>
                                        @endif
                                        @if (config('setting.social.youtube'))
                                            <li class="youtube">
                                                <a href="{{ config('setting.social.youtube') }}">
                                                    @svg('fab-youtube')
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
