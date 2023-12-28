<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <title>RHP Software - Kurulum</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <style>
        strong svg {
            width: 20px;
            margin-right: 0.25em;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left active">
                <a href="{{ route('admin.index') }}" class="logo logo-normal">
                    <img src="{{ asset('assets/admin/img/logo.png') }}" alt="">
                </a>
                <a href="{{ route('admin.index') }}" class="logo logo-white">
                    <img src="{{ asset('assets/admin/img/logo-white.png') }}" alt="">
                </a>
                <a href="{{ route('admin.index') }}" class="logo-small">
                    <img src="{{ asset('assets/admin/img/logo-small.png') }}" alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>
        </div>

        <div class="page-wrapper m-0 pagehead">
            <div class="content">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">

                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ __('Admin/general.error') }} !</strong> {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endforeach
                        @endif

                        @if (session()->has("info"))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>@svg("ri-information-fill")</strong> {{ session("info") }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kurulum</h3>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'setup.store']) !!}
                                <div class="form-group">
                                    {!! Form::label('Veri Tabanı Adı') . formInfo('Veritabanının Eklendiğinden Emin Olun') !!}
                                    {!! Form::text('db_name') !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Kullanıcı Adı') !!}
                                    {!! Form::text('user') !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Parola') !!}
                                    {!! Form::text('password') !!}
                                </div>
                                {!! Form::submit(__("admin/general.save"), ["class"=>"btn btn-primary"]) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
    </div>
    @include('Admin.layout.script')
    @yield('script')
    @include('Admin.layout.alert')
</body>

</html>
