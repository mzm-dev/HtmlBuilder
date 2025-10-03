<div class="mb-4">
    <label for="separator_style" class="block text-gray-700 font-semibold mb-2">Separator Style</label>
    <select wire:model.defer="editingElementData.attributes.border" id="separator_style"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        @foreach (Mzm\HtmlBuilder\Enums\SeparatorStyle::cases() as $style)
            <option value="{{ $style->value }}">{{ $style->label() }}</option>
        @endforeach
    </select>
</div>
