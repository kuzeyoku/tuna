<footer class="footer widget-footer style1 bg-base-dark text-base-white overflow-hidden clearfix">
    <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
    <div class="prt-section-hili-dot style1"></div>
    <div class="second-footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 widget-area ">
                    <div class="widget widget_text clearfix res-991-mt-50">
                        <div class="textwidget widget-text">
                            <p>{{ config('setting.general.description') }}</p>
                        </div>
                        <div class="widget_social_wrapper social-icons pt-15">
                            <h3 class="fs-18 mb-20">{{ __('front/footer.fallow_us') }}</h3>
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
                                    <li><a href="{{ config('setting.social.instagram') }}" rel="noopener"
                                            aria-label="instagram"><i class="icon-instagram"></i></a></li>
                                @endif
                                @if (config('setting.social.youtube'))
                                    <li><a href="{{ config('setting.social.youtube') }}" rel="noopener"
                                            aria-label="youtube"><i class="icon-youtube"></i></a></li>
                                @endif
                                @if (config('setting.social.linkedin'))
                                    <li><a href="{{ config('setting.social.linkedin') }}" rel="noopener"
                                            aria-label="linkedin"><i class="icon-linkedin"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area">
                    <div class="widget multi_widget clearfix">
                        <div class="widget_nav_menu clearfix">
                            <h3 class="widget-title">{{ __('front/footer.pages') }}</h3>
                            <ul class="menu-footer-quick-links links-1">
                                @foreach ($pages as $page)
                                    <li><a href="{{ $page->getUrl() }}">{{ $page->getTitle() }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 widget-area">
                    <div class="widget multi_widget clearfix">
                        <div class="newsletter_widget clearfix">
                            <h3 class="widget-title">{{ __('front/footer.newsletter') }}</h3>
                            {{ Form::open(['url' => route('newsletter.store'), 'class' => 'newsletter-form style1']) }}
                            <p>
                                {{ Form::email('n_email', null, ['placeholder' => __('front/footer.newsletter_email_placeholder')]) }}
                            </p>
                            @if ($errors->has('n_email'))
                                <span class="text-danger">{{ $errors->first('n_email') }}</span>
                            @endif
                            <p>
                                <button type="submit" class="g-recaptcha"
                                    data-sitekey="{{ config('setting.recaptcha.site_key') }}" data-callback="contact"
                                    data-action="submit"><i class="icon-paper-plane"></i></button>
                            </p>
                            <p class="cookies">
                                {{ Form::checkbox('n_terms', true, false, ['id' => 'n_terms']) }}
                                <label for="n_terms"></label>{{ __('front/footer.newsletter_terms_label') }}
                                @if ($errors->has('n_terms'))
                                    <br>
                                    <span class="text-danger">{{ $errors->first('n_terms') }}</span>
                                @endif
                            </p>
                            {{ Form::close() }}
                        </div>
                        <div class="featured-icon-box icon-align-before-content style1">
                            <div class="featured-icon">
                                <div
                                    class="prt-icon prt-icon_element-onlytxt prt-icon_element-color-skincolor prt-icon_element-size-md">
                                    <i class="flaticon flaticon-customer-service"></i>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-desc">
                                    <p><a
                                            href="tel:{{ config('setting.contact.phone') }}">{{ config('setting.contact.phone') }}</a>
                                    </p>
                                    <p><a class="underline"
                                            href="mailto:{{ config('setting.contact.email') }}">{{ config('setting.contact.email') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="prt-section-hili-dot style2"></div>
    <div class="bottom-footer-text copyright ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cpy-text">
                        <ul class="footer-nav-menu">
                            @if ($terms)
                                <li><a href="{{ $terms->getUrl() }}">{{ $terms->getTitle() }}</a></li>
                            @endif
                            @if ($cookie)
                                <li><a href="{{ $cookie->getUrl() }}">{{ $cookie->getTitle() }}</a></li>
                            @endif
                            @if ($privacy)
                                <li><a href="{{ $privacy->getUrl() }}">{{ $privacy->getTitle() }}</a></li>
                            @endif
                            @if ($kvkk)
                                <li><a href="{{ $kvkk->getUrl() }}">{{ $kvkk->getTitle() }}</a></li>
                            @endif
                        </ul>
                        <p>{!! __('front/footer.copyright', [
                            'year' => date('Y'),
                            'title' => config('setting.general.title'),
                            'url' => 'https://www.kuzeyoku.com.tr',
                            'author' => env('APP_NAME'),
                        ]) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
