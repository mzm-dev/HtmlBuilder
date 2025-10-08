@props(['editingElementData', 'formElements' => []])

<div class="mb-4">
    <label class="block text-gray-700 font-semibold mb-2">Required If</label>
    <div class="flex items-center space-x-2">
        <div class="w-1/2">
            <label for="required_if_field" class="text-sm text-gray-600">Another Field's Name</label>
            <select wire:model.defer="editingElementData.validation.required_if.field" id="required_if_field"
                class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Select a field --</option>
                @foreach (collect($formElements)->whereIn('type', ['input-text', 'input-number', 'input-email', 'input-textarea-input', 'input-select-input', 'input-radio-buttons', 'input-checkbox-buttons']) as $element)
                    {{-- Don't allow an element to depend on itself --}}
                    @if ($element['id'] !== $editingElementData['id'])
                        @php
                            $fieldName = \Illuminate\Support\Str::snake(str_replace(' ', '_', $element['label']));
                        @endphp
                        <option value="{{ $fieldName }}">{{ Str::words($element['label'], 2) }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="w-1/3">
            <label for="required_if_value" class="text-sm text-gray-600">Has the Value</label>
            <input type="text" wire:model.defer="editingElementData.validation.required_if.value"
                id="required_if_value" placeholder="value"
                class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
    </div>
</div>
