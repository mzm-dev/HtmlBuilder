<div x-show="showModal" x-cloak class="fixed inset-0 z-50" x-on:keydown.escape.window="showModal = false">
    <!-- Background overlay -->
    <div x-show="showModal" x-transition:enter="transition-opacity ease-in-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in-out duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-gray-600/75" x-on:click="showModal = false"></div>

    <!-- Sliding sidebar -->
    <div x-show="showModal" x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 flex h-full w-full max-w-md flex-col bg-white shadow-2xl">
        @if ($editingElementData)
            <!-- Dialog Header -->
            <div
                class="flex items-center justify-between border-b border-neutral-300 bg-gray-800 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-white dark:text-white">
                    Edit: {{ $editingElementData['label'] }}
                </h3>
                <button x-on:click="showModal = false" aria-label="close modal" class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="saveElement" class="flex-grow overflow-y-auto px-8 py-4">
                {{-- Common fields --}}
                <x-mzm-html-builder::element-options :grids="$grids" :editingElementData="$editingElementData" :formElements="$formElements" />
            </form>
            <div
                class="flex flex-col-reverse justify-between gap-2 text-white border-t border-neutral-300 bg-gray-800 p-2 sm:flex-row sm:items-center md:justify-end">
                <button type="button" x-on:click="showModal = false"
                    class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 ">Cancel</button>
                <button type="submit" form="edit-element-form" wire:click="saveElement"
                    class="whitespace-nowrap rounded-sm bg-white border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-gray-800 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0">Save
                    Changes</button>
            </div>
        @endif
    </div>
</div>
