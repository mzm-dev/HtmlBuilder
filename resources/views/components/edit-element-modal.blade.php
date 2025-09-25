@props(['editingElementData'])

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
                <div class="mb-4">
                    <label for="label" class="block text-gray-700 font-semibold mb-2">Label</label>
                    <input type="text" wire:model.defer="editingElementData.label" id="label"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    @error('editingElementData.label')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                @if ($editingElementData['type'] === 'text-block')
                    <div class="mb-4">
                        <label for="header_attr" class="block text-gray-700 font-semibold mb-2">Tag</label>
                        <select wire:model.defer="editingElementData.attr" id="header_attr"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="p">Paragraph</option>
                            <option value="h1">H1</option>
                            <option value="h2">H2</option>
                            <option value="h3">H3</option>
                            <option value="h4">H4</option>
                            <option value="h5">H5</option>
                            <option value="h6">H6</option>
                            <option value="blockquote">Blockquote</option>
                            <option value="address">Address</option>
                        </select>
                    </div>
                @endif

                @if ($editingElementData['type'] === 'number-input')
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
                @elseif (in_array($editingElementData['type'], ['text-input', 'email', 'textarea-input']))
                    <div class="mb-4">
                        <label for="placeholder" class="block text-gray-700 font-semibold mb-2">Placeholder</label>
                        <input type="text" wire:model.defer="editingElementData.placeholder" id="placeholder"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </div>
                @endif

                @if (in_array($editingElementData['type'], ['select-input', 'radio-buttons', 'checkbox-buttons']))
                    <div class="mb-4">
                        <label for="placeholder" class="block text-gray-700 font-semibold mb-2">Placeholder</label>
                        <input type="text" wire:model.defer="editingElementData.placeholder" id="placeholder"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4 p-4 border border-gray-200 rounded-md">
                        <label class="block text-gray-700 font-semibold mb-3">Options</label>
                        @foreach ($editingElementData['options'] as $index => $option)
                            <div class="flex items-center mb-2"
                                wire:key="option-{{ $editingElementData['id'] }}-{{ $index }}">
                                <input type="text"
                                    wire:model.defer="editingElementData.options.{{ $index }}.value"
                                    placeholder="Value"
                                    class="w-full p-2 border border-gray-300 rounded-md mr-2 focus:ring-blue-500 focus:border-blue-500">
                                <input type="text"
                                    wire:model.defer="editingElementData.options.{{ $index }}.label"
                                    placeholder="Label"
                                    class="w-full p-2 border border-gray-300 rounded-md mr-2 focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" wire:click="moveOption({{ $index }}, 'up')"
                                    class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if ($loop->first) disabled @endif>
                                    <i class="fa-solid fa-arrow-up fa-sm"></i>
                                </button>
                                <button type="button" wire:click="moveOption({{ $index }}, 'down')"
                                    class="p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if ($loop->last) disabled @endif>
                                    <i class="fa-solid fa-arrow-down fa-sm"></i>
                                </button>
                                <button type="button" wire:click="removeOption({{ $index }})"
                                    class="p-2 text-red-500 hover:text-red-700 rounded-full hover:bg-red-100">
                                    <i class="fa-solid fa-trash-can fa-sm"></i>
                                </button>
                            </div>
                        @endforeach
                        <button type="button" wire:click="addOption"
                            class="text-blue-600 hover:text-blue-800 font-semibold mt-2">
                            <i class="fa-solid fa-plus-circle mr-1 fa-sm"></i> Add Option
                        </button>
                    </div>
                @endif

                @if ($editingElementData['type'] === 'button')
                    <div class="mb-4">
                        <label for="button_type" class="block text-gray-700 font-semibold mb-2">Button
                            Type</label>
                        <select wire:model.defer="editingElementData.attributes.type" id="button_type"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="button">button</option>
                            <option value="submit">submit</option>
                            <option value="reset">reset</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="button_color" class="block text-gray-700 font-semibold mb-2">Color
                            Theme</label>
                        <select wire:model.defer="editingElementData.attributes.color" id="button_color"
                            class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                            <option value="red">Red</option>
                            <option value="yellow">Yellow</option>
                            <option value="indigo">Indigo</option>
                            <option value="purple">Purple</option>
                            <option value="pink">Pink</option>
                            <option value="gray">Gray</option>
                            <option value="black">Black</option>
                        </select>
                    </div>
                @endif

                @if ($editingElementData['type'] !== 'text-block')
                    <div class="mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.defer="editingElementData.required"
                                class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Required</span>
                        </label>
                    </div>
                @endif

            </form>
            <div
                class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">

                <button x-on:click="showModal = false" type="button"
                    class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:text-neutral-300 dark:focus-visible:outline-white">Cancel</button>
                <button type="submit" form="edit-element-form" wire:click="saveElement"
                    class="whitespace-nowrap rounded-sm bg-black border border-black dark:border-white px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Save
                    Changes</button>
            </div>
        @endif
    </div>
</div>
