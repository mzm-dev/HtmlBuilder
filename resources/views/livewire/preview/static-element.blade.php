@props(['element'])

@switch($element['type'])
    @case('button')
        <x-mzm-html-builder::elements.button :element="$element" :wire-model="true" />
    @break

    @case('text-block')
        <x-mzm-html-builder::elements.text-block :element="$element" />
    @break

    @case('separator')
        <x-mzm-html-builder::elements.separator :element="$element" />
    @break

    @default
        {{-- Render elemen input statis jika tidak memiliki 'name' --}}
        @php $element['attributes']['disabled'] = true; @endphp
@endswitch
