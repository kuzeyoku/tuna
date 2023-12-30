<div>
    <aside class="widget widget-search with-title">
        @if ($categories->count() > 0)
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
        @endif
        @if ($popularPost->count() > 0)
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
        @endif
        @if (count(App\Models\Blog::uniqueTags()) > 0)
            <div class="tagcloud-widget">
                <h3 class="widget-title">Tags</h3>
                <div class="tagcloud">
                    @foreach (App\Models\Blog::uniqueTags() as $tag)
                        <a class="tag-cloud-link">{{ $tag }}</a>
                    @endforeach
                </div>
            </div>
        @endif
    </aside>
</div>
