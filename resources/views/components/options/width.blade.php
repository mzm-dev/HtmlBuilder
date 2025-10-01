@props([
    'width' => ['1' => '1/4 Column', '2/4 Column', '3/4 Column', 'Full Width'],
])

<div class="mb-4">
    <label for="width" class="block text-gray-700 font-semibold mb-2">Width</label>
    <select wire:model.defer="editingElementData.colspan" id="width"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        <option value="">-- Select a width --</option>

        @foreach ($width as $value => $item)
            <option value="{{ $value }}">{{ $item }}</option>
        @endforeach
    </select>
</div>
