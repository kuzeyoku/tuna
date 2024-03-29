<li class="mega-menu-item">
    <a href="{{ $menu->url ?? '#' }}" class="mega-menu-link">{{ $menu->title }}</a>
    <ul class="mega-submenu sub-menu">
        @foreach ($menu->subMenu as $subMenu)
            @if ($subMenu->subMenu->count() > 0)
                @include('layout.menu', ['menu' => $subMenu])
            @else
                <li><a href="{{ $subMenu->url }}">{{ $subMenu->title }}</a></li>
            @endif
        @endforeach
    </ul>
</li>
