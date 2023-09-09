@if ($data->lastPage() > 1)
    <div class="wrap-pagination-info">
        <ul class="page-numbers">
            {{-- Previous Page Link --}}
            @if (!$data->onFirstPage())
            <li><a class="page-number-item" href="{{ $data->previousPageUrl() }}">Previous</a></li>
            @endif

            {{-- Pagination Links --}}
            @for ($i = 1; $i <= $data->lastPage(); $i++)
                <li><a class="page-number-item {{ $i == $data->currentPage() ? 'current' : '' }}" href="{{ $data->url($i) }}">{{ $i }}</a></li>
            @endfor

            {{-- Next Page Link --}}
            @if ($data->hasMorePages())
                <li><a class="page-number-item next-link" href="{{ $data->nextPageUrl() }}">Next</a></li>
            @endif
        </ul>
        <p class="result-count">Showing {{ $data->firstItem() }}-{{ $data->lastItem() }} of {{ $data->total() }} results</p>
    </div>
@endif
