<div class="mb-4" x-data="{
    selectedColor: @entangle('editingElementData.attributes.color').live
}">
    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Color</label>
    <div class="flex flex-wrap gap-3">
        @foreach (Mzm\HtmlBuilder\Enums\Color::cases() as $color)
            <div class="flex items-center">
                <input type="radio" id="color-{{ $color->value }}" name="button_color" value="{{ $color->value }}"
                    x-model="selectedColor" class="hidden" />
                <label for="color-{{ $color->value }}"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full border dark:border-neutral-700 cursor-pointer transition-all duration-150 ease-in-out"
                    :class="{ 'ring-2 ring-offset-2 ring-blue-500 dark:ring-offset-neutral-800 border-blue-500': selectedColor === '{{ $color->value }}' }">
                    <span class="size-4 rounded-full {{ $color->tailwindClass() }}"></span>
                    <span class="text-sm">{{ $color->label() }}</span>
                </label>
            </div>
        @endforeach
    </div>
</div>
