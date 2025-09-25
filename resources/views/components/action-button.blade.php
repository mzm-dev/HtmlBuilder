@props([
    'color' => 'gray',
])

@php
    // $baseClasses =
    //     'inline-flex justify-center items-center aspect-square whitespace-nowrap rounded-full p-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed';
    // $colorClasses = "bg-{$color}-500 focus-visible:outline-{$color}-500 dark:bg-{$color}-500 dark:focus-visible:outline-{$color}-500";

    $baseClasses = 'flex items-center justify-center aspect-square whitespace-nowrap p-2 rounded-full disabled:opacity-50 disabled:cursor-not-allowed';

    $colorClasses = "text-{$color}-500 hover:text-{$color}-700 hover:bg-{$color}-100";
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => "{$baseClasses} {$colorClasses}"]) }}>
    {{ $slot }}
</button>
