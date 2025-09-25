@if ($element['label'])
    @if (isset($element['attr']) && $element['type'] === 'text-block')
        {!! "<{$element['attr']}>" . $element['label'] . "</{$element['attr']}>" !!}
    @else
        <label class="w-fit pl-0.5 text-sm">
            {{ $element['label'] ?? '' }}
            {!! isset($element['required']) && $element['required'] ? '<span class="text-red-500">*</span>' : '' !!}
        </label>
    @endif
@endif
