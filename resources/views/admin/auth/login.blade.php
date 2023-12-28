<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ __('admin/auth.title') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <script src="{{ asset('assets/admin/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ asset('assets/admin/img/logo.png') }}" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>{{ __('admin/auth.welcome') }}</h3>
                            <h4>{{ __('admin/auth.please_login') }}</h4>
                        </div>
                        @include('admin.layout.alert')
                        {!! Form::open(['url' => route('admin.auth.authenticate'), 'method' => 'post', 'id' => 'login-form']) !!}
                        <div class="form-group">
                            {!! Form::label('email', __('admin/auth.email')) !!}
                            {!! Form::email('email', null, ['placeholder' => __('admin/auth.email_placeholder')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', __('admin/auth.password')) !!}
                            {!! Form::password('password', ['placeholder' => __('admin/auth.password_placeholder')]) !!}
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                        <div class="form-login">
                            {!! Form::submit(__('admin/auth.login'), [
                                'class' => 'btn btn-login g-recaptcha',
                                'data-sitekey' => config('setting.recaptcha.site_key'),
                                'data-callback' => 'onSubmit',
                                'data-action' => 'submit',
                            ]) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{ asset('assets/admin/img/login.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
    @if (config('setting.recaptcha.status') == App\Enums\StatusEnum::Active->value)
        <script>
            function onSubmit(token) {
                document.getElementById("login-form").submit();
            }
        </script>
    @endif
</body>

</html>
