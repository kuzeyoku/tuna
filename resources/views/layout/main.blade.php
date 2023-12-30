<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Minemo - Mining & Minerals Business HTML Template">
    <meta name="keywords"
        content="Minemo - Mining & Minerals Business WordPress Theme, Minemo - Mining & Minerals Business Html Template, themes & template, html5 template, WordPress theme, unlimited colors available, ui/ux,ui/ux design, best html template, html template, html, JavaScript, best css theme,css3, elementor theme, latest premium themes 2023, latest premium templates 2023, preyan technosys Pvt.Ltd,cymol themes, themetech mount,Web 3.0,multi-theme, website theme and template, woocommerce, bootstrap template, web templates, responsive theme,services,web design and development, business, company, bitcoinmining, mining, mining life, mining engineering, coal mining, mining town, gold mining, mining heritage, mining history, mineral mining, mining industry, construction, quarry mining, machine">
    <meta name="author" content="https://www.preyantechnosys.com/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('setting.general.title') }}</title>

    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontello.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prettyPhoto.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shortcodes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/megamenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    <link rel='stylesheet' href="{{ asset('assets/revolution/css/rs6.css') }}">
</head>

<body>
    <div class="page">
        @include('layout.header')

        @yield('content')

        @include('layout.footer')

        <a id="totop" href="#top">
            <i class="icon-angle-up"></i>
        </a>

    </div>

    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.3.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-validate.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/numinate.min.js') }}"></script>
    <script src="{{ asset('assets/js/cursor.min.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.js') }}"></script>
    <script src="{{ asset('assets/js/splittext.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrolltrigger.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <!-- Revolution Slider -->
    @yield('script')
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    @include('layout.alert')
    <script>
        AOS.init({
            offset: 120,
            duration: 400,
        });
    </script>

</body>

</html>
