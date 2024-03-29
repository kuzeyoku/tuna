<section class="prt-row padding_zero-section clearfix">
    <div class="container-fulid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title title-style-center_text">
                    <div class="title-header">
                        <h3>{{ __('front/product.txt1') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row slick_slider spacing-2"
            data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "arrows":false, "autoplay":true, "dots":false, "infinite":true, "responsive":[{"breakpoint":1200,"settings": {"slidesToShow": 3}}, {"breakpoint":900,"settings":{"slidesToShow": 3}},{"breakpoint":768,"settings":{"slidesToShow": 2}},{"breakpoint":545,"settings":{"slidesToShow": 1}}]}'>
            @foreach ($product as $product)
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="featured-imagebox featured-imagebox-services style1">
                        <div class="featured-thumbnail">
                            <img class="img-fluid" src="{{ $product->image_url }}" alt="image" width="740"
                                height="500">
                        </div>
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3><a href="{{ $product->url }}">{{ $product->title }}</a></h3>
                            </div>
                            <div class="featured-desc">
                                {{ $product->short_description }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
