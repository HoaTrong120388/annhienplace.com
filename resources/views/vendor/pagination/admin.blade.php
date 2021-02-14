@if ($paginator->hasPages())
<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{-- <li class="disabled"><span>&laquo;</span></li> --}}
        @else
            <li><a class="pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="javascript:void(0);" class= "pagination__link pagination__link--active">{{ $page }}</a></li>
                    @else
                        <li><a class="pagination__link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            {{-- <li class="disabled"><span>&raquo;</span></li> --}}
        @endif
    </ul>
</div>
@endif
