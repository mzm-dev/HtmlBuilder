@props(['element'])

@php
    $border = $element['attributes']['border'] ?? 'none';
    $color = $element['attributes']['color'] ?? 'gray';
    $borderColorClass = "border-{$color}-300 dark:border-{$color}-600";
@endphp

@if ($border != 'none')
    <div class="inset-0 flex items-center my-4 " aria-hidden="true">
        <div class="w-full border-t {{ $borderColorClass }}"
            style="border-top-style: {{ $element['attributes']['border'] }};">
        </div>
    </div>
@endif
