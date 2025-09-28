@props([
    'types' => ['Button', 'Submit', 'Reset'],
    'colors' => ['Blue', 'Green', 'Red', 'Yellow', 'Indigo', 'Purple', 'Pink', 'Gray', 'Black'],
])
<div class="mb-4">
    <label for="button_type" class="block text-gray-700 font-semibold mb-2">Button
        Type</label>
    <select wire:model.defer="editingElementData.attributes.type" id="button_type"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        @foreach ($types as $item)
            <option value="{{ strtolower($item) }}">{{ $item }}</option>
        @endforeach

    </select>
</div>

<div class="mb-4">
    <label for="button_color" class="block text-gray-700 font-semibold mb-2">Color
        Theme</label>
    <select wire:model.defer="editingElementData.attributes.color" id="button_color"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        @foreach ($colors as $item)
            <option value="{{ strtolower($item) }}">{{ $item }}</option>
        @endforeach
    </select>
</div>
