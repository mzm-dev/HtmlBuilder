<label class="block text-gray-700 font-semibold mb-2">Between</label>
<div class="space-y-2">
    <div class="flex items-center space-x-2">
        <div class="mb-4 w-1/4">
            <label for="gt_field" class="block text-gray-700 font-semibold mb-2">Min Value</label>
            <input type="number" wire:model.defer="editingElementData.validation.between.min" placeholder="Min"
                class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
        <span class="text-gray-500">and</span>
        <div class="mb-4 w-1/4">
            <label for="lt_field" class="block text-gray-700 font-semibold mb-2">Max Value</label>
            <input type="number" wire:model.defer="editingElementData.validation.between.max" placeholder="Max"
                class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
    </div>
</div>
