{{-- 
@if ($paginator->hasPages())

    <ul class="pagination">
        
        @if ($paginator->onFirstPage())
            <li class="page-item disabled page-link"><span>@lang('pagination.previous')</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif --}}


@if ($paginator->hasPages())
<div class="filter">
    <div class="button-group filters-button-group">
        @if ($paginator->onFirstPage())
        <a class="button page-item disabled is-checked"><span class="">@lang('pagination.previous')</span></a>
        @else
        <a class="button page-item" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
        @endif

        @if ($paginator->hasMorePages())
        <a class="button" href="{{ $paginator->nextPageUrl() }}" rel="next"><span>@lang('pagination.next')</span></a>
        @else
        <a class="button disabled is-checked"><span class="">@lang('pagination.next')</span></a>
        @endif
    </div>
</div>
@endif