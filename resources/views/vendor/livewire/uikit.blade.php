<div>
    @if ($paginator->hasPages())
        <ul class="uk-pagination">
            {{-- Previous Page Link --}}
            {{--
            @if ($paginator->onFirstPage())
                <li class="uk-disabled">
                    <span>
                        &lsaquo; 1
                    </span>
                </li>
            @else
                <li>
                    <button type="button" dusk="previousPage" class="page-link" wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                        &lsaquo; 2
                    </button>
                </li>
            @endif
            --}}
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="uk-disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="uk-active" wire:key="paginator-page-{{ $page }}"><span>{{ $page }}</span></li>
                        @else
                            <li wire:key="paginator-page-{{ $page }}"><a href="#" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            {{--
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button" dusk="nextPage" class="page-link" wire:click="nextPage" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</button>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
            --}}
        </ul>
    @endif
</div>
