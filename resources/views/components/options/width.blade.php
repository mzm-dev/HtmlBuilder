<div class="mb-4">
    <label for="width" class="block text-gray-700 font-semibold mb-2">Width</label>
    <select wire:model.defer="editingElementData.colspan" id="width"
        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        <option value="1">1/4 Column</option>
        <option value="2">2/4 Column</option>
        <option value="3">3/4 Column</option>
        <option value="4">Full Width</option>
    </select>
    @error('editingElementData.colspan')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
