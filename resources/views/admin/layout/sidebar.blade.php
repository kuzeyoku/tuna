<div class="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.index') }}">@svg('fas-tachometer-alt')<span> Ana Sayfa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.setting') }}">@svg('fas-cogs')<span> Site Ayarları</span>
                    </a>
                </li>
                @foreach (App\Enums\ModuleEnum::cases() as $module)
                @if ($module->status())
                @if (count($module->menu()) == 1)
                <li>
                    <a href="{{ route("admin.{$module->route()}.index") }}">@svg($module->icon())
                        <span>{{ $module->title() }}</span>
                    </a>
                </li>
                @else
                <li class="submenu">
                    <a href="javascript:void(0);">
                        @svg($module->icon())
                        <span>{{ $module->title() }}</span>
                        <span class="menu-arrow">
                            {{ svg('fas-angle-right') }}
                        </span>
                    </a>
                    <ul>
                        @foreach ($module->menu() as $key => $value)
                        <li>
                            <a href="{{ route("admin.{$module->route()}.{$key}") }}">
                                {{ $value }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
