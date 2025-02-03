<!-- //////////////////////////////////////////// PAGINATION //////////////////////////////////////////// -->
@php
    $visibleRange = 5;
    $halfRange = floor($visibleRange / 2);
    $startPage = max(1, $paginator->currentPage() - $halfRange);
    $endPage = min($paginator->lastPage(), $paginator->currentPage() + $halfRange);

    // Adjust start and end pages if they are out of bounds
    if ($startPage > 1) {
        $endPage = min($paginator->lastPage(), $endPage + $startPage - 1);
    } else {
        $endPage = min($paginator->lastPage(), $visibleRange);
    }

    if ($endPage === $paginator->lastPage()) {
        $startPage = max(1, $paginator->lastPage() - $visibleRange + 1);
    }
@endphp

@if ($paginator->lastPage() > 1)
    <div class="uk-grid-collapse" uk-grid>
        <div class="uk-width-expand uk-flex uk-flex-middle">
            <span class="uk-text-small">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results</span>
        </div>
        <div class="uk-width-auto uk-flex uk-flex-middle">
            <div class="uk-grid-collapse" uk-grid>
                <div class="uk-width-auto">
                    <div class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                        <a href="{{ $paginator->url(1) }}"><i class="fa-light fa-caret-left fa-nm"></i></a>
                    </div>
                </div>
                <div class="uk-width-expand">
                    @foreach (range($startPage, $endPage) as $page)
                        @if ($loop->first && $page > 1)
                            <span>...</span>
                        @endif

                        <a href="{{ $paginator->url($page) }}">
                            <span class="uk-text-small custom-button-pagination custom-margin-spacing @if($paginator->currentPage() == $page) custom-number-pagination @endif">
                                {{ $page }}
                            </span>
                        </a>

                        @if ($loop->last && $page < $paginator->lastPage())
                            <span>...</span>
                        @endif
                    @endforeach
                </div>
                <div class="uk-width-auto">
                    <div class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                        <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" ><i class="fa-light fa-caret-right fa-nm"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- //////////////////////////////////////////// PAGINATION //////////////////////////////////////////// -->