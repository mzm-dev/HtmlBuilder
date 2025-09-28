@php
    $textBlockClasses = [
        'p' => 'text-base',
        'h1' => 'text-5xl font-bold',
        'h2' => 'text-4xl font-bold',
        'h3' => 'text-3xl font-bold',
        'h4' => 'text-2xl font-bold',
        'h5' => 'text-xl font-bold',
        'h6' => 'text-lg font-bold',
        'blockquote' => 'text-lg italic border-l-4 border-gray-300 pl-4',
        'address' => 'text-base not-italic',
    ];
    $elementClass = (isset($element['attr']) && isset($textBlockClasses[$element['attr']])) ? $textBlockClasses[$element['attr']] : '';
@endphp

@if ($element['label'])
    @if (isset($element['attr']) && $element['type'] === 'text-block')
        {!! "<{$element['attr']} class='$elementClass'>" . $element['label'] . "</{$element['attr']}>" !!}
    @else
        <label class="w-fit pl-0.5 text-sm">
            {{ $element['label'] ?? '' }}
            {!! isset($element['required']) && $element['required'] ? '<span class="text-red-500">*</span>' : '' !!}
        </label>
    @endif
@endif
