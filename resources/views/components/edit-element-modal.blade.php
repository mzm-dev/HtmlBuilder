<div x-show="showModal" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-gray-600 flex items-center justify-center z-50" x-on:keydown.escape.window="showModal = false"
    style="background-color: rgba(0,0,0,0.5);">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl flex flex-col max-h-[90vh]"
        @click.away="showModal = false"> {{-- This is what closes the modal on an outside click --}}
        @if ($editingElementData)
            <!-- Dialog Header -->
            <div
                class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">
                    Edit: {{ $editingElementData['label'] }}
                </h3>
                <button x-on:click="showModal = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="saveElement" class="flex-grow overflow-y-auto px-8 py-4">
                {{-- Common fields --}}
                <x-mzm-html-builder::options.fields :editingElementData="$editingElementData" :formElements="$formElements" />
            </form>
            <div
                class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 sm:flex-row sm:items-center md:justify-end">
                <button x-on:click="showModal = false" type="button"
                    class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 ">Cancel</button>
                <button type="submit" form="edit-element-form" wire:click="saveElement"
                    class="whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0">Save
                    Changes</button>
            </div>
        @endif
    </div>
</div>
