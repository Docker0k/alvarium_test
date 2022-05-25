@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */
    $next = null;
    $prev = null;
    $selected = $select_pages ?? [];
    if($paginator->hasPages()){
        $paginator->nextPageUrl() !== null ? $next = $paginator->nextPageUrl($paginator) . ($query ?? '') : $next = null;
        $paginator->previousPageUrl() !== null ? $prev = $paginator->previousPageUrl() . ($query ?? '') : $prev = null;
    }
@endphp
@if($next || $prev)
    @push('meta-next-prev')
        @if($next)
            <link rel="next" href="{{$next}}"/>
        @endif
        @if($prev)
            <link rel="prev" href="{{$prev}}"/>
        @endif
    @endpush
@endif
@if ($paginator->hasPages())
    <ul class="pagination">
        @if($prev)
            <li class="pagination__item">
                <a href="{{$prev}}" class="pagination__button">&laquo; Previous</a>
            </li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="pagination__item">
                    <a  class="pagination__link">{{ $element }}</a>
                </li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage() || in_array($page, $selected))
                        <li class="pagination__item">
                            <a class="pagination__link is-active">{{ $page }}</a>
                        </li>
                    @else
                        <li class="pagination__item">
                            <a href="{{ $paginator->url($page) . ($query ?? '') }}" class="pagination__link">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if($next)
            <li class="pagination__item">
                <a href="{{$next}}" class="pagination__link pagination__button">Next &raquo</a>
            </li>
        @endif
    </ul>
@endif
