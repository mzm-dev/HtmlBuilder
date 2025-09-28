<div class="mb-4">
    <label for="placeholder" class="block text-gray-700 font-semibold mb-2">Placeholder</label>
    <input type="text" wire:model.defer="editingElementData.placeholder" id="placeholder"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>
<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label for="min" class="block text-gray-700 font-semibold mb-2">Min</label>
        <input type="number" wire:model.defer="editingElementData.min" id="min"
            class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
        <label for="max" class="block text-gray-700 font-semibold mb-2">Max</label>
        <input type="number" wire:model.defer="editingElementData.max" id="max"
            class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
    </div>
</div>
