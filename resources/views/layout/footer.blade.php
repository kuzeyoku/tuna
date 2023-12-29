<footer class="footer widget-footer style1 bg-base-dark text-base-white overflow-hidden clearfix">
    <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
    <div class="prt-section-hili-dot style1"></div>
    <div class="second-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="border-top"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 widget-area ">
                    <div class="widget widget_text clearfix res-991-mt-50">
                        <div class="textwidget widget-text">
                            <p>{{ config('setting.general.description') }}</p>
                        </div>
                        <div class="widget_social_wrapper social-icons pt-15">
                            <h3 class="fs-18 mb-20">Bizi Takip Et</h3>
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
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 widget-area">
                    <div class="widget multi_widget clearfix">
                        <div class="widget_nav_menu clearfix">
                            <h3 class="widget-title">Quick links</h3>
                            <ul class="menu-footer-quick-links links-1">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Company News</a></li>
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">Case Studies</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-2 widget-area">
                    <div class="widget multi_widget clearfix">
                        <div class="widget_nav_menu clearfix">
                            <h3 class="widget-title">Our Services</h3>
                            <ul class="menu-footer-quick-links links-1">
                                <li><a href="#"> Mining Sector</a></li>
                                <li><a href="#">Project pricing</a></li>
                                <li><a href="#">Client testimonials</a></li>
                                <li><a href="#">Our Philosophy</a></li>
                                <li><a href="#">Cost Calculator</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 widget-area">
                    <div class="widget multi_widget clearfix">
                        <div class="newsletter_widget clearfix">
                            <h3 class="widget-title">Bültene Abone Ol</h3>
                            {{ Form::open(['url' => route('newsletter.store'), 'class' => 'newsletter-form style1']) }}
                            <p>{{ Form::email('email', null, ['placeholder' => __('front/contact.form_email_placeholder')]) }}
                            </p>
                            <p><button type="submit" class="g-recaptcha"
                                    data-sitekey="{{ config('setting.recaptcha.site_key') }}" data-callback="contact"
                                    data-action="submit"><i class="icon-paper-plane"></i></button></p>
                            <p class="cookies">
                                {{ Form::checkbox('terms', true, false, ['id' => 'terms']) }}
                                <label for="terms"></label>Gönderilen verilerin toplanmasını ve saklanmasını kabul
                                ediyorum.
                            </p>
                            {{ Form::close() }}
                        </div>
                        <!--featured-icon-box-->
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
                        </div><!-- featured-icon-box end-->
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
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Procurement</a></li>
                        </ul>
                        <p>Copyright © 2023 <a href="{{ route('home') }}">{{ config('setting.general.title') }}</a>.
                            Designed By
                            <a href="">{{ ENV('APP_NAME') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
