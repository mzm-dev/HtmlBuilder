@props(['data' => 'previewData','element', 'name'])
@php
    use Mzm\HtmlBuilder\Enums\ElementType;
    $wireModel = $data . '.' . $name;
@endphp

@switch($element['type'])
    @case(ElementType::InputText->value)
        <x-mzm-html-builder::elements.input-text :element="$element" :wire-model="$wireModel" />
        @break
    @case(ElementType::InputEmail->value)
        <x-mzm-html-builder::elements.input-email :element="$element" :wire-model="$wireModel" />
        @break
    @case(ElementType::InputTextarea->value)
        <x-mzm-html-builder::elements.input-textarea :element="$element" :wire-model="$wireModel" />
        @break
    @case(ElementType::InputSelect->value)
        <x-mzm-html-builder::elements.input-select :element="$element" :wire-model="$wireModel" />
        @break
    @case(ElementType::InputRadio->value)
        <x-mzm-html-builder::elements.input-radio-buttons :element="$element" :wire-model="$wireModel" />
        @break
    @case(ElementType::InputCheckbox->value)
        <x-mzm-html-builder::elements.input-checkbox-buttons :element="$element" :wire-model="$wireModel" />
        @break
    @case(ElementType::InputNumber->value)
        <x-mzm-html-builder::elements.input-number :element="$element" :wire-model="$wireModel" />
        @break
    @case(ElementType::InputDate->value)
        <x-mzm-html-builder::elements.input-date :element="$element" :wire-model="$wireModel" />
        @break
@endswitch

@error($wireModel)
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
