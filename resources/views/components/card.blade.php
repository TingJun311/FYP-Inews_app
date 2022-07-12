
{{-- This card component will reuse by merge will other component --}}
<div {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6' ]) }}>
    {{ $slot }}
</div>