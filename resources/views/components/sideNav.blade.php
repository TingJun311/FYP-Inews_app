
@props(['curCategory'])

@php
    $category = [
        'business' => null,
        'entertainment' => null,
        'health' => null,
        'sciences' => null,
        'sports' => null,
        'technology' => null
    ];

    switch ($curCategory) {
        case 'business':
            $category['business'] = 'active';
            break;
        case 'entertainment':
            $category['entertainment'] = 'active';
            break;
        case 'health':
            $category['health'] = 'active';
            break;
        case 'sciences':
            $category['sciences'] = 'active';
            break;
        case 'sports':
            $category['sports'] = 'active';
            break;
        case 'technology':
            $category['technology'] = 'active';
            break;
        default:
            break;
    }
@endphp
<div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 300px; position: fixed;" id="sideNav">
    <div class="list-group list-group-flush border-bottom scrollarea">
        <a href="/category/business" class="list-group-item {{ $category['business'] }} list-group-item-action py-3 lh-tight" aria-current="true">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <strong class="mb-1">Business</strong>
            </div>
        </a>
        <a href="/category/entertainment" class="list-group-item {{ $category['entertainment'] }} list-group-item-action py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <strong class="mb-1">Entertainment</strong>
            </div>
        </a>
        <a href="/category/health" class="list-group-item {{ $category['health'] }} list-group-item-action py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <strong class="mb-1">Health</strong>
            </div>
        </a>
        <a href="/category/sciences" class="list-group-item {{ $category['sciences'] }} list-group-item-action py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <strong class="mb-1">Sciences</strong>
            </div>
        </a>
        <a href="/category/sports" class="list-group-item {{ $category['sports'] }} list-group-item-action py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <strong class="mb-1">Sports</strong>
            </div>
        </a>
        <a href="/category/technology" class="list-group-item {{ $category['technology'] }} list-group-item-action py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <strong class="mb-1">Technology</strong>
            </div>
        </a>
    </div>
</div>    
