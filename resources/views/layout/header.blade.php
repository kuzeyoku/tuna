<header id="masthead" class="header prt-header-style-01">
    <div class="top_bar bg-base-dark text-base-white clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top_bar_inner text-base-white">
                        <div class="site-branding">
                            <h1><a class="home-link" href="index.html" title="Minemo" rel="home">
                                    <img id="logo-img" height="45" width="224" class="img-fluid auto_size"
                                        src="{{ asset('assets/images/logo-light.svg') }}" alt="logo-img">
                                </a></h1>
                        </div>
                        <div class="top_bar_contact_item with-icon top_bar_address ms-auto">
                            <div class="top_bar_icon"><i class="fa fa-thumb-tack"></i></div>
                            <span>{{ config('setting.contact.address') }}</span>
                        </div>
                        <div class="top_bar_contact_item with-icon top_bar_call">
                            <div class="top_bar_icon"><i class="fa fa-phone"></i></div>
                            <span>Call Us:</span><span class="topbar_icon-txt"><a class="text-base-skin"
                                    href="tel:{{ config('setting.contact.phone') }}">
                                    {{ config('setting.contact.phone') }}</a></span>
                        </div>
                        <div class="top_bar_contact_item top_bar_social">
                            <ul class="social-icons">
                                <li class="prt-social-facebook"><a href="https://www.facebook.com/preyantechnosys19"
                                        rel="noopener" aria-label="facebook">fb</a>
                                </li>
                                <li class="prt-social-twitter"><a href="https://twitter.com/PreyanTechnosys"
                                        rel="noopener" aria-label="twitter">tw</a>
                                </li>
                                <li class="prt-social-linkedin"><a
                                        href="https://www.linkedin.com/in/preyan-technosys-pvt-ltd/" rel="noopener"
                                        aria-label="linkedin">in</a>
                                </li>
                                <li class="prt-social-instagram"><a href="https://dribbble.com/PreyanTechnosys"
                                        rel="noopener" aria-label="dribbble">db</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="site-header-menu" class="site-header-menu">
        <div class="site-header-menu-inner prt-stickable-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="site-navigation">
                            <div class="site-branding site-branding-02  me-auto">
                                <a class="home-link" href="index.html" title="Minemo" rel="home">
                                    <img id="logo-imgs" height="45" width="224" class="img-fluid auto_size"
                                        src="{{ asset('assets/images/logo-light.svg') }}" alt="logo-img">
                                </a>
                            </div>
                            <div class="">
                                <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                    <span class="menubar-box">
                                        <span class="menubar-inner"></span>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <nav class="main-menu menu-mobile" id="menu">
                                        <ul class="menu">
                                            @foreach ($headerMenu as $menu)
                                                @if ($menu->parent_id === 0)
                                                    @if ($menu->subMenu->count() > 0)
                                                        @include('layout.menu', ['menu' => $menu])
                                                    @else
                                                        <li class="mega-menu-item has-submenu">
                                                            <a class="mega-menu-link"
                                                                href="{{ $menu->url }}">{{ $menu->getTitle() }}</a>
                                                        </li>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </ul>
                                    </nav>
                                    <div class="header_extra">
                                        <div class="header_btn">
                                            <a class="prt-btn prt-btn-size-md prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor"
                                                href="{{ route('contact.index') }}">İletişim</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
