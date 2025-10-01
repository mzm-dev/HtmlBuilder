<div class="mb-4">
    <label for="placeholder" class="block text-gray-700 font-semibold mb-2">Placeholder</label>
    <input type="text" wire:model.defer="editingElementData.placeholder" id="placeholder"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>
<div class="mb-4 p-4 border border-gray-200 rounded-md">
    <label class="block text-gray-700 font-semibold mb-3">Options</label>
    @foreach ($editingElementData['options'] as $index => $option)
        <div class="flex items-center mb-2" wire:key="option-{{ $editingElementData['id'] }}-{{ $index }}">
            <input type="text" wire:model.defer="editingElementData.options.{{ $index }}.value"
                placeholder="Value"
                class="w-full p-2 border border-gray-300 rounded-md mr-2 focus:ring-blue-500 focus:border-blue-500">
            <input type="text" wire:model.defer="editingElementData.options.{{ $index }}.label"
                placeholder="Label"
                class="w-full p-2 border border-gray-300 rounded-md mr-2 focus:ring-blue-500 focus:border-blue-500">
            <button type="button" wire:click="moveOption({{ $index }}, 'up')"
                class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                @if ($loop->first) disabled @endif>
                <i class="fa-solid fa-arrow-up fa-sm"></i>
            </button>
            <button type="button" wire:click="moveOption({{ $index }}, 'down')"
                class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                @if ($loop->last) disabled @endif>
                <i class="fa-solid fa-arrow-down fa-sm"></i>
            </button>
            <button type="button" wire:click="removeOption({{ $index }})"
                class="p-2 text-red-500 hover:text-red-700 rounded-full hover:bg-red-100">
                <i class="fa-solid fa-trash-can fa-sm"></i>
            </button>
        </div>
    @endforeach
    <button type="button" wire:click="addOption" class="text-blue-600 hover:text-blue-800 font-semibold mt-2">
        <i class="fa-solid fa-plus-circle mr-1 fa-sm"></i> Add Option
    </button>
</div>

