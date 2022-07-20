
@props(['currentPage', 'totalPage'])

@php
    $paginateButton = [
        'previous' => null,
        'next' => null
    ];
    
    $paginateButton['previous'] = ($currentPage <= 1)? 'disabled' : '';
    $paginateButton['next'] = ($currentPage == $totalPage)? 'disabled' : '';
    
@endphp
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item {{ $paginateButton['previous'] }}">
            <a class="page-link" href="/page/{{ $currentPage - 1 }}">Previous</a>
        </li>
        <li class="page-item active">
            <a class="page-link" href="#">{{ $currentPage }}</a>
        </li>
        <li class="page-item {{ $paginateButton['next'] }}">
            <a class="page-link" href="/page/{{ $currentPage + 1 }}">Next</a>
        </li>
    </ul>
</nav>