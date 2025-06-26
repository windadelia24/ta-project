@if ($paginator->hasPages())
    <nav aria-label="Pagination Navigation" role="navigation">
        <div class="d-flex justify-content-between align-items-center">
            {{-- Previous Page Link --}}
            <div class="flex-fill d-flex justify-content-start">
                @if ($paginator->onFirstPage())
                    <span class="btn btn-outline-secondary disabled">
                        <i class="fas fa-chevron-left"></i> Previous
                    </span>
                @else
                    <a class="btn btn-outline-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                @endif
            </div>

            {{-- Pagination Elements --}}
            <div class="d-flex justify-content-center">
                <ul class="pagination pagination-sm mb-0">
                    {{-- First Page Link --}}
                    @if ($paginator->currentPage() > 3)
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                        </li>
                        @if ($paginator->currentPage() > 4)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                    @endif

                    {{-- Previous Two Pages --}}
                    @for ($i = max(1, $paginator->currentPage() - 2); $i < $paginator->currentPage(); $i++)
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Current Page --}}
                    <li class="page-item active">
                        <span class="page-link">{{ $paginator->currentPage() }}</span>
                    </li>

                    {{-- Next Two Pages --}}
                    @for ($i = $paginator->currentPage() + 1; $i <= min($paginator->lastPage(), $paginator->currentPage() + 2); $i++)
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Last Page Link --}}
                    @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                        @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Next Page Link --}}
            <div class="flex-fill d-flex justify-content-end">
                @if ($paginator->hasMorePages())
                    <a class="btn btn-outline-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="btn btn-outline-secondary disabled">
                        Next <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>

        {{-- Results Info --}}
        <div class="d-flex justify-content-center mt-3">
            <small class="text-muted">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
            </small>
        </div>
    </nav>
@endif
