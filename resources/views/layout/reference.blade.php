<section class="prt-row padding_zero-section partner-section clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-border-top"></div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="pt-80 res-991-pt-60" data-aos="zoom-in" data-aos-duration="600">
                    <div class="slick_slider"
                        data-slick='{"slidesToShow": 5, "slidesToScroll": 1, "arrows":false, "autoplay":true, "infinite":true, "responsive": [{"breakpoint":1200,"settings":{"slidesToShow": 5}}, {"breakpoint":1024,"settings":{"slidesToShow": 4}}, {"breakpoint":777,"settings":{"slidesToShow": 3}},{"breakpoint":575,"settings":{"slidesToShow": 2}},{"breakpoint":380,"settings":{"slidesToShow": 1}}]}'>
                        @foreach ($reference as $reference)
                            <div class="client-box">
                                <div class="prt-client-logo-tooltip">
                                    <div class="prt-client-logo-tooltip-inner">
                                        <div class="client-thumbnail">
                                            <img width="171" height="32" class="img-fluid"
                                                src="{{ $reference->getImageUrl() }}" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
