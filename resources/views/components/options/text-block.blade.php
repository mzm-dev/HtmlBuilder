<div class="mb-4">
    <label for="header_attr" class="block text-gray-700 font-semibold mb-2">Tag</label>
    <select wire:model.defer="editingElementData.attr" id="header_attr"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        @foreach (Mzm\HtmlBuilder\Enums\TextBlockTag::cases() as $tag)
            <option value="{{ $tag->value }}">{{ $tag->label() }}</option>
        @endforeach
    </select>
</div>
