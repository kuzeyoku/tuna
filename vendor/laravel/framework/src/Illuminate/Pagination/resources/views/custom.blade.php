@if ($paginator->hasPages())
    <div class="pagination-block">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a class="next page-numbers" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i
                    class="icon-arrow-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-numbers current"><span>{{ $page }}</span></span>
                    @else
                        <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}" rel="next"><i
                    class="icon-arrow-right"></i></a>
        @endif
    </div>

@endif
