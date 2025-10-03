@php
    use Mzm\HtmlBuilder\Enums\ElementType;

    $type = $editingElementData['type'] ?? null;
    $config = null;

    if ($type) {
        // Use tryFrom to safely get the enum case from the string value.
        $enumCase = ElementType::tryFrom($type);
        if ($enumCase) {
            // Call the config() method on the enum case to get component and rules.
            $config = $enumCase->config();
        }
    }
@endphp

{{-- Label --}}
<x-mzm-html-builder::options.label />

@if (isset($config['component']))
    <x-dynamic-component :component="$config['component']" :editingElementData="$editingElementData" :formElements="$formElements" />
@endif
@if (!empty($config['rules']))
    <x-mzm-html-builder::options.accordion-rules :editingElementData="$editingElementData" :formElements="$formElements" :rules="$config['rules']" />
@endif
<x-mzm-html-builder::options.accordion-style :editingElementData="$editingElementData" :formElements="$formElements" :type="$type" />
