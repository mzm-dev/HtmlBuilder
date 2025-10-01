
<div class="mb-4 w-1/4">
    <label for="gt_field" class="block text-gray-700 font-semibold mb-2">Greater Than</label>
    <input type="number" wire:model.defer="editingElementData.validation.gt" id="gt_field" placeholder="value"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>

<div class="mb-4 w-1/4">
    <label for="lt_field" class="block text-gray-700 font-semibold mb-2">Less Than</label>
    <input type="number" wire:model.defer="editingElementData.validation.lt" id="lt_field" placeholder="value"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
</div>
