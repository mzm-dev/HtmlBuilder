@php
    // Map element types to their corresponding component views
    $componentMap = [
        'text-block' => [
            'component' => 'mzm-html-builder::options.text-block',
            'rules' => [],
        ],
        'number-input' => [
            'component' => 'mzm-html-builder::options.number-input',
            'rules' => ['required', 'required-if', 'between', 'gt', 'regex'],
        ],
        'text-input' => [
            'component' => 'mzm-html-builder::options.input',
            'rules' => ['required', 'required-if', 'regex'],
        ],
        'email' => [
            'component' => 'mzm-html-builder::options.input',
            'rules' => ['required', 'required-if', 'regex'],
        ],
        'textarea-input' => [
            'component' => 'mzm-html-builder::options.input',
            'rules' => ['required', 'required-if', 'regex'],
        ],
        'date' => [
            'component' => 'mzm-html-builder::options.input',
            'rules' => ['required', 'required-if'],
        ],
        'select-input' => [
            'component' => 'mzm-html-builder::options.input-options',
            'rules' => ['required']
        ],
        'radio-buttons' => [
            'component' => 'mzm-html-builder::options.input-options',
            'rules' => ['required']
        ],
        'checkbox-buttons' => [
            'component' => 'mzm-html-builder::options.input-options',
            'rules' => ['required']
        ],
        'button' => [
            'component' => 'mzm-html-builder::options.button',
            'rules' => [],
        ],
    ];

    $type = $editingElementData['type'] ?? null;
    $componentName = $componentMap[$type] ?? null;
@endphp

{{-- Label --}}
<x-mzm-html-builder::options.label />

@if ($componentName['component'])
    <x-dynamic-component :component="$componentName['component']" :editingElementData="$editingElementData" :formElements="$formElements" />
@endif
@if (!empty($componentName['rules']))
    <x-mzm-html-builder::options.accordion-rules :editingElementData="$editingElementData" :formElements="$formElements" :rules="$componentName['rules']" />
@endif
<x-mzm-html-builder::options.accordion-style :editingElementData="$editingElementData" :formElements="$formElements" :type="$type" />
