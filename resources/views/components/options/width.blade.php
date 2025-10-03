<div class="mb-4">
    <label for="width" class="block text-gray-700 font-semibold mb-2">Width</label>
    <select wire:model.defer="editingElementData.colspan" id="width"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        <option value="">-- Select a width --</option>

        @foreach (Mzm\HtmlBuilder\Enums\ElementWidth::cases() as $width)
            <option value="{{ $width->value }}">{{ $width->label() }}</option>
        @endforeach
    </select>
</div>
