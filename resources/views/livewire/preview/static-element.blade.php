@props(['formElements','element'])

@php
    use Mzm\HtmlBuilder\Enums\ElementType;
@endphp

@switch($element['type'])
    @case(ElementType::Button->value)
        <x-mzm-html-builder::elements.button :element="$element" :wire-model="true" />
    @break

    @case(ElementType::TextBlock->value)
        <x-mzm-html-builder::elements.text-block :element="$element" />
    @break

    @case(ElementType::Separator->value)
        <x-mzm-html-builder::elements.separator :element="$element" />
    @break

    @default
        {{-- Render elemen input statis jika tidak memiliki 'name' --}}
        @php $element['attributes']['disabled'] = true; @endphp
@endswitch
