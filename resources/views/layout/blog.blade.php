<section class="prt-row blog-section clearfix" data-aos="fade-up" data-aos-duration="1500">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="section-title mb-0">
                        <div class="title-header pb-0">
                            <h3>BLOG & HABERLER</h3>
                        </div>
                    </div>
                    <div class="blog-btn res-575-mt-20">
                        <a class="prt-btn prt-btn-size-md prt-btn-shape-round prt-btn-style-fill prt-btn-color-darkcolor border-color"
                            href="{{ route('blog.index') }}">Blog</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-40 res-767-mt-20">
            @foreach ($blog as $post)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="featured-imagebox featured-imagebox-post style1">
                        <div class="featured-thumbnail">
                            <a href="{{ $post->getUrl() }}"><img class="img-fluid" src="{{ $post->getImageUrl() }}"
                                    alt="image" width="740" height="500"></a>
                        </div>
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3><a href="{{ $post->getUrl() }}">{{ $post->getTitle() }}</a></h3>
                            </div>
                            <div class="featured-desc">
                                <p>{{ $post->getShortDescription() }}</p>
                            </div>
                            <div>
                                <a class="prt-btn btn-inline prt-icon-btn-right prt-btn-size-md btn-underline"
                                    href="{{ $post->getUrl() }}">Detaylar</a>
                                <span class="prt-meta-line date-link"><time class="entry-date published"
                                        datetime="{{ $post->updated_at }}">{{ $post->updated_at->translatedFormat('d M Y') }}</time></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
