@props([
    'colors' => ['Blue', 'Green', 'Red', 'Yellow', 'Indigo', 'Purple', 'Pink', 'Gray'],
])

<div class="mb-4" x-data="{
    selectedColor: @entangle('editingElementData.attributes.color').live
}">
    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Color</label>
    <div class="flex flex-wrap gap-3">
        @foreach ($colors as $color)
            @php
                $colorValue = strtolower($color);
                // Define Tailwind CSS background color classes for each color name.
                // This is necessary because Tailwind cannot generate classes dynamically at runtime.
                $colorClasses = [
                    'blue' => 'bg-blue-600',
                    'green' => 'bg-green-600',
                    'red' => 'bg-red-600',
                    'yellow' => 'bg-yellow-600',
                    'indigo' => 'bg-indigo-600',
                    'purple' => 'bg-purple-600',
                    'pink' => 'bg-pink-600',
                    'gray' => 'bg-gray-600',
                    'black' => 'bg-black',
                ];
                $bgColorClass = $colorClasses[$colorValue] ?? 'bg-gray-200';
            @endphp
            <div class="flex items-center">
                <input type="radio" id="color-{{ $colorValue }}" name="button_color" value="{{ $colorValue }}"
                    x-model="selectedColor" class="hidden" />
                <label for="color-{{ $colorValue }}"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full border dark:border-neutral-700 cursor-pointer transition-all duration-150 ease-in-out"
                    :class="{ 'ring-2 ring-offset-2 ring-blue-500 dark:ring-offset-neutral-800 border-blue-500': selectedColor === '{{ $colorValue }}' }">
                    <span class="size-4 rounded-full {{ $bgColorClass }}"></span>
                    <span class="text-sm">{{ $color }}</span>
                </label>
            </div>
        @endforeach
    </div>
</div>
