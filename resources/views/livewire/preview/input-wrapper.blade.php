@props(['element', 'name'])

@php
    $wireModel = 'previewData.' . $name;
@endphp

@switch($element['type'])
    @case('text-input')
        <x-mzm-html-builder::elements.text-input :element="$element" :wire-model="$wireModel" />
        @break
    @case('email')
        <x-mzm-html-builder::elements.email :element="$element" :wire-model="$wireModel" />
        @break
    @case('textarea-input')
        <x-mzm-html-builder::elements.textarea :element="$element" :wire-model="$wireModel" />
        @break
    @case('select-input')
        <x-mzm-html-builder::elements.select :element="$element" :wire-model="$wireModel" />
        @break
    @case('radio-buttons')
        <x-mzm-html-builder::elements.radio :element="$element" :wire-model="$wireModel" />
        @break
    @case('checkbox-buttons')
        <x-mzm-html-builder::elements.checkbox :element="$element" :wire-model="$wireModel" />
        @break
    @case('number-input')
        <x-mzm-html-builder::elements.number-input :element="$element" :wire-model="$wireModel" />
        @break
    @case('date')
        <x-mzm-html-builder::elements.date :element="$element" :wire-model="$wireModel" />
        @break
@endswitch

@error($wireModel)
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
