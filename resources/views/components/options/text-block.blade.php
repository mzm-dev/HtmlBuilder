@props([
    'attrs' => [
        'p' => 'Paragraph',
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
        'blockquote' => 'Blockquote',
        'address' => 'Address',
    ],
])
<div class="mb-4">
    <label for="header_attr" class="block text-gray-700 font-semibold mb-2">Tag</label>
    <select wire:model.defer="editingElementData.attr" id="header_attr"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        @foreach ($attrs as $value =>$item)
            <option value="{{ $value }}">{{ $item }}</option>
        @endforeach
    </select>
</div>
