@if ($paginator->hasPages())
<style>
    .flex-container{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin-right: 15px;
    }

    .pagination a, .pagination span {
        display: inline-block;
        padding: 2px 10px;
        text-decoration: none;
        font-weight: 500;
    }

    .pagination a {
        color: var(--c-text-primary);

        &:hover {
            color: #23adade1;
        }
    }

    .pagination .active {
        background: #23adad;
        border-radius: 5px;
        color: #fff;
        pointer-events: initial;
    }

    .semibold{
        font-weight: 500;
    }

    p{
        font-size: 0.9rem;
    }

    #dots{
        color: #23adade1;
    }
    
</style>
    <nav>
        <div class="flex-container">
            <div>
                <p>
                    {!! __('Showing') !!}
                    <span class="semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li id="dots" class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
