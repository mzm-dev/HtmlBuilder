@props(['editingElementData', 'formElements' => []])

<div class="mb-4">
    <label for="placeholder" class="block text-gray-700 font-semibold mb-2">Placeholder</label>
    <input type="text" wire:model.defer="editingElementData.placeholder" id="placeholder"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>
<div class="mb-4">
    <label for="helpText" class="block text-gray-700 font-semibold mb-2">Help Text</label>
    <input type="text" wire:model.defer="editingElementData.helpText" id="helpText"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>
