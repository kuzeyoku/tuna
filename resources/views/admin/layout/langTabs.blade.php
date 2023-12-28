<ul class="nav mb-3">
    @foreach (languageList() as $lang)
        <li class="nav-item">
            <a class="nav-link rounded {{ $lang->code == config('app.fallback_locale') ? 'active' : '' }}"
                data-bs-toggle="tab" href="#{{ $lang->code }}" aria-selected="false" tabindex="-1">
                <span class="d-none d-sm-block">{{ $lang->title }}</span>
            </a>
        </li>
    @endforeach
</ul>
