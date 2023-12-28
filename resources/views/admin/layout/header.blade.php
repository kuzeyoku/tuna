<div class="header">
    <div class="header-left active">
        <a href="{{ route('admin.index') }}" class="logo logo-normal">
            <img src="{{ asset('assets/admin/img/logo.png') }}">
        </a>
        <a href="{{ route('admin.index') }}" class="logo logo-white">
            <img src="{{ asset('assets/admin/img/logo-white.png') }}">
        </a>
        <a href="{{ route('admin.index') }}" class="logo-small">
            <img src="{{ asset('assets/admin/img/logo-small.png') }}">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">
        <li class="nav-item dropdown main-drop">
            <a href="{{ route("admin.cache-clear") }}" class="dropdown-toggle nav-link userset">
                @svg('fas-brush') {{ __('admin/general.cacheclear') }}
            </a>
        </li>
        <li class="nav-item dropdown main-drop">
            <a href="{{ url('/') }}" class="dropdown-toggle nav-link userset blank">
                @svg('fas-arrow-pointer') {{ __('admin/general.gofront') }}
            </a>
        </li>
        <li class="nav-item dropdown main-drop">
            <a href="{{ route('admin.auth.logout') }}" class="dropdown-toggle nav-link userset">
                @svg('fas-person-running') {{ __('admin/general.logout') }}
            </a>
        </li>
    </ul>
</div>
