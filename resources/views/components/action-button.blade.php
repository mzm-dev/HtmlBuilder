@props([
    'color' => 'gray',
])

@php
    $baseClasses = 'flex items-center justify-center aspect-square whitespace-nowrap p-2 rounded-full disabled:opacity-50 disabled:cursor-not-allowed';

    $colorClasses = "text-{$color}-500 hover:text-{$color}-700 hover:bg-{$color}-100";
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => "{$baseClasses} {$colorClasses}"]) }}>
    {{ $slot }}
</button>
