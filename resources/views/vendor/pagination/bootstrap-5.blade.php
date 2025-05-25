@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"
                          style="background-color: #f1f1f1; border: none;">
                        ‹
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->previousPageUrl() }}"
                       rel="prev"
                       style="background-color: var(--color-primary); color: white; border: none;">
                        ‹
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link"
                              style="background-color: #f1f1f1; border: none;">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Page Numbers --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link"
                                      style="background-color: var(--color-dark); color: white; border: none;">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                   href="{{ $url }}"
                                   style="background-color: var(--color-medium); color: white; border: none;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next"
                       style="background-color: var(--color-primary); color: white; border: none;">
                        ›
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link"
                          style="background-color: #f1f1f1; border: none;">
                        ›
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
