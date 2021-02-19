@if ($paginator->hasPages())
<div class="row justify-content-center">
    <!-- === pagination === -->
    <div class="pagination-wrapper">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                {{-- <li class="disabled"><span>&laquo;</span></li> --}}
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="javascript:void(0);">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @else
                {{-- <li class="disabled"><span>&raquo;</span></li> --}}
            @endif
            
        </ul>
    </div> <!--/pagination-->
</div>
@endif