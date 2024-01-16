<div>
    <aside class="widget widget-search with-title">
        @if ($categories->count() > 0)
            <div class="widget-categories">
                <h3 class="widget-title">{{ __('front/blog.txt5') }}</h3>
                <ul>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ $category->getUrl(\App\Enums\ModuleEnum::Blog) }}">{{ $category->title }}</a>
                            <span>{{ $category->countBlogs() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($popularPost->count() > 0)
            <div class="widget-recent-post">
                <h3 class="widget-title">{{ __('front/blog.txt6') }}</h3>
                <ul class="widget-post prt-recent-post-list">
                    @foreach ($popularPost as $post)
                        <li>
                            <div class="post-detail">
                                <span class="post-tag">{{ $post->category_title }}</span>
                                <a href="{{ $post->url }}">{{ $post->title }}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </aside>
</div>
