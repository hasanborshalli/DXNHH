@if ($paginator->hasPages())
    <nav class="pager" role="navigation" aria-label="Pagination Navigation">
        <div class="pager-inner">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="pager-btn disabled" aria-disabled="true">‹ Prev</span>
            @else
                <a class="pager-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹ Prev</a>
            @endif

            {{-- Pagination Elements --}}
            <div class="pager-pages" aria-label="Pagination Pages">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="pager-ellipsis">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="pager-page active" aria-current="page">{{ $page }}</span>
                            @else
                                <a class="pager-page" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="pager-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">Next ›</a>
            @else
                <span class="pager-btn disabled" aria-disabled="true">Next ›</span>
            @endif
        </div>
    </nav>
@endif
