<div class="mb-6">
    <div class="block text-gray-700 font-semibold mb-2">Presence</div>
    <div class="flex flex-col space-y-2">
        <label class="flex items-center cursor-pointer">
            <input type="radio" name="presence" value="required" wire:model.defer="presence"
                class="form-radio h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
            <span class="ml-2 text-gray-700">Required</span>
        </label>
        <p class="ml-6 text-xs text-gray-500">The field must have a value.</p>

        <label class="flex items-center cursor-pointer">
            <input type="radio" name="presence" value="nullable" wire:model.defer="presence"
                class="form-radio h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
            <span class="ml-2 text-gray-700">Nullable</span>
        </label>
        <p class="ml-6 text-xs text-gray-500">The field can be null.</p>

        <label class="flex items-center cursor-pointer">
            <input type="radio" name="presence" value="optional" wire:model.defer="presence"
                class="form-radio h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
            <span class="ml-2 text-gray-700">Optional (Default)</span>
        </label>
        <p class="ml-6 text-xs text-gray-500">The field is not required.</p>
    </div>
</div>
