@if ($paginator->hasPages())
    <div class="ops-pagination">
        <span class="ops-pagination-info">
            Showing 
            @if ($paginator->firstItem())
                <strong>{{ $paginator->firstItem() }}</strong>
                to
                <strong>{{ $paginator->lastItem() }}</strong>
            @else
                {{ $paginator->count() }}
            @endif
            of
            <strong>{{ $paginator->total() }}</strong>
            categories
        </span>

        <div class="ops-pagination-links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="disabled" aria-disabled="true" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="disabled" aria-disabled="true">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="disabled" aria-disabled="true" aria-label="Next">
                    <i class="bi bi-chevron-right"></i>
                </span>
            @endif
        </div>
    </div>
@endif
