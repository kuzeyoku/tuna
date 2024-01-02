@extends('layout.main')
@section('title', __('front/contact.title'))
@section('content')
    <div class="site-main">
        <section class="prt-row bg-base-dark map-section overflow-hidden clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 col-sm-12">
                        <div class="map-contact">
                            <div class="section-title">
                                <div class="title-header pb-0">
                                    <h2 class="title mb-15">{{ __('front/contact.title') }}</h2>
                                </div>
                                <div class="title-desc">
                                    <p>{{ __('front/contact.description') }}</p>
                                </div>
                            </div>
                            <div class="map-contect">
                                <div class="copy-text mt-20 res-767-mt-0">
                                    <p class="map-contact-link">{{ __('front/contact.call') }} <span id="p1"><a
                                                href="#"
                                                class="text-base-skin">{{ config('setting.contact.phone') }}</a></span></p>
                                    <button class="copytext" onclick="copyToClipboard('#p1')"><i
                                            class="flaticon flaticon-copy"></i></button>
                                </div><br>
                                <div class="copy-text copy-text-email">
                                    <p id="p2" class="map-contact-link-02 underline text-base-white"><a
                                            href="#">{{ config('setting.contact.email') }}</a></p>
                                    <button class="copytext" onclick="copyToClipboard('#p2')"><i
                                            class="flaticon flaticon-copy"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div id="google_map" class="google_map res-767-pt-30">
                            <div class="map_container style1">
                                <div id="map">
                                    <iframe src="{{ config('setting.contact.map') }}" width="1920" height="952"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="prt-row workplace-section clearfix">
            <div class="container">
                <div class="row bg-base-white align-items-center spacing-9">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                        <div class="pr-40 res-1199-pr-0">
                            <div class="section-title">
                                <div class="title-header">
                                    <h2 class="title">{{ __('front/contact.title') }}</h2>
                                </div>
                                <div class="title-desc">
                                    <p>{{ __('front/contact.description') }}</p>
                                </div>
                            </div>
                            <ul class="social-icons contact-link">
                                @if (config('setting.social.facebook'))
                                    <li class="mb-2"><a href="{{ config('setting.social.facebook') }}" rel="noopener"
                                            aria-label="facebook"><i class="fa fa-facebook"></i>Facebook</a></li>
                                @endif
                                @if (config('setting.social.twitter'))
                                    <li class="mb-2"><a href="{{ config('setting.social.twitter') }}" rel="noopener"
                                            aria-label="twitter"><i class="fa fa-twitter"></i>Twitter</a></li>
                                @endif
                                @if (config('setting.social.instagram'))
                                    <li class="mb-2"><a href="{{ config('setting.social.instagram') }}" rel="noopener"
                                            aria-label="instagram"><i class="fa fa-instagram"></i>Instagram</a></li>
                                @endif
                                @if (config('setting.social.youtube'))
                                    <li class="mb-2"><a href="{{ config('setting.social.youtube') }}" rel="noopener"
                                            aria-label="youtube"><i class="fa fa-youtube"></i>Youtube</a></li>
                                @endif
                                @if (config('setting.social.linkedin'))
                                    <li class="mb-2"><a href="{{ config('setting.social.linkedin') }}" rel="noopener"
                                            aria-label="youtube"><i class="fa fa-linkedin"></i>Linkedin</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                        <div id="comments" class="comments-area style1 pl-55 res-1199-pl-0 res-1199-pt-30">
                            <div class="comment-respond">
                                {{ Form::open(['url' => route('contact.send'), 'method' => 'POST', 'class' => 'comment-form']) }}
                                <p>
                                    {{ Form::text('name', null, ['placeholder' => __('front/contact.form_name')]) }}
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </p>
                                <p>
                                    {{ Form::email('email', null, ['placeholder' => __('front/contact.form_email')]) }}
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </p>
                                <p>
                                    {{ Form::text('phone', null, ['placeholder' => __('front/contact.form_phone')]) }}
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </p>
                                <p>
                                    {{ Form::text('subject', null, ['placeholder' => __('front/contact.form_subject')]) }}
                                    @if ($errors->has('subject'))
                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                    @endif
                                </p>
                                <p>
                                    {{ Form::textarea('message', null, ['placeholder' => __('front/contact.form_message'), 'rows' => 5]) }}
                                    @if ($errors->has('message'))
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                    @endif
                                </p>
                                <p class="terms">
                                    {{ Form::checkbox('terms', null, false, ['id' => 'terms']) }}
                                    <label for="terms"></label>
                                    <a href="" target="_blank">Kullanım
                                        Koşulları</a> ve <a href="" target="_blank">Gizlilik Politikası</a> okudum ve
                                    kabul ediyorum.
                                    @if ($errors->has('terms'))
                                        <span class="text-danger">{{ $errors->first('terms') }}</span>
                                    @endif
                                </p>
                                <p>
                                    {{ Form::submit(__('front/contact.form_send'), [
                                        'class' =>
                                            'g-recaptcha submit prt-btn prt-btn-size-md prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor mr-25 res-575-mb-10',
                                        'data-sitekey' => config('setting.recaptcha.site_key'),
                                        'data-callback' => 'contact',
                                        'data-action' => 'submit',
                                    ]) }}
                                </p>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
