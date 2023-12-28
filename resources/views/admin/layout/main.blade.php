<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('pageTitle')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dropify.min.css') }}">
    @yield('style')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="main-wrapper">
        @include('admin.layout.header')
        @include('admin.layout.sidebar')
        <div class="page-wrapper pagehead">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ __('admin/general.error') }} !</strong> {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif
                        <div class="card">
                            <div class="card-header d-flex flex-row justify-content-between">
                                <h3 class="card-title">@yield('pageTitle')</h3>
                                @yield('button')
                            </div>
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                        @yield('card')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.script')
    @yield('script')
    @include('admin.layout.alert')
</body>

</html>
