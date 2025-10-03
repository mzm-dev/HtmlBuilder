@php
    use Mzm\HtmlBuilder\Enums\ElementType;
@endphp
<div x-data="formbuilder" x-on:show-edit-modal.window="showModal = true" x-on:hide-edit-modal.window="showModal = false"
    class="relative flex w-full flex-col md:flex-row" x-init="showPreviewModal = false">

    <nav x-cloak
        class="fixed left-0 z-20 flex h-svh w-60 shrink-0 flex-col border-r border-neutral-300 bg-neutral-50 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:border-neutral-700 dark:bg-neutral-900"
        x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">

        <!-- sidebar links  -->
        <div class="flex flex-col gap-2 overflow-y-auto pb-6">

            <a href="#"
                class="flex items-center gap-2 mt-2 px-2 py-1.5 text-sm rounded-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                <span>Block Elements</span>
            </a>
            <ul>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('text-block')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-paragraph w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Text Block</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('separator')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-ellipsis w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Separator</span>
                    </button>
                </li>
            </ul>
            <a href="#"
                class="flex items-center gap-2 mt-2 px-2 py-1.5 text-sm rounded-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                <span>Form Elements</span>
            </a>
            <ul>

                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('input-text')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-i-cursor w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Text Input</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('input-email')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-at w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Email Input</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('input-number')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-hashtag w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Number Input</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('input-date')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-calendar-day w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Date Field</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('input-textarea-input')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-rectangle-list  w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Textarea</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('input-select-input','options')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-chevron-down w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Select Dropdown</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('input-radio-buttons','options')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-regular fa-dot-circle w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Radio Buttons</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('input-checkbox-buttons','options')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-regular fa-check-square w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Checkbox Buttons</span>
                    </button>
                </li>
                <li class="py-0.5 border-neutral-300 dark:border-neutral-700">
                    <button type="button" wire:click="addElement('button')"
                        class="cursor-pointer flex items-center w-full gap-2 px-2 py-1.5 text-sm rounded-sm text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                        <i class="fa-solid fa-mattress-pillow w-6 text-center text-gray-500 fa-sm"></i>
                        <span>Button</span>
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- main content  -->
    <div class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
        <!-- Add main content here  -->
        <div class="mx-auto p-4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Form Builder</h1>
                <div class="flex items-center space-x-4">
                    <button type="button" x-on:click="showPreviewModal = true"
                        class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700">
                        <i class="fa-solid fa-eye fa-sm"></i>
                        <span>Preview</span>
                    </button>
                    <button type="button" wire:click="saveForm"
                        class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-700">
                        <i class="fa-solid fa-save fa-sm"></i>
                        <span>Save Form</span>
                    </button>
                </div>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg mb-6">
                <div class="mb-3">
                    <label for="formTitle" class="block text-gray-700 font-semibold mb-2">Form Name</label>
                    <input type="text" wire:model.defer="formTitle" id="formTitle"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    @error('formTitle')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formDescriptions" class="block text-gray-700 font-semibold mb-2">Form
                        Descriptions</label>
                    <textarea wire:model.defer="formDescriptions" id="formDescriptions"
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                    @error('formDescriptions')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg min-h-[600px]">

                @if (empty($formElements))
                    <div
                        class="flex flex-col items-center justify-center h-full text-center text-gray-500 border-2 border-dashed border-gray-300 rounded-lg py-24">
                        <i class="fa-solid fa-object-group fa-4x text-gray-400 mb-4 fa-sm"></i>
                        <h3 class="text-xl font-semibold">Your Form is Empty</h3>
                        <p class="mt-2">Click on an element from the left panel to add it to your form.</p>
                    </div>
                @else
                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($formElements as $element)
                            @php

                                $colspan = $element['colspan'] ?? 3;
                            @endphp
                            <div
                                class="mb-1 border border-gray-300 p-4 rounded-lg hover:border-blue-500 hover:shadow-md transition-all duration-200 relative group items-start col-span-{{ $colspan }}">
                                <!-- Clickable Area for Editing -->
                                <div
                                    class="flex flex-row ms-3 mb-1 sm:float-none space-x-1 {{ $colspan == 1 ? 'md:float-none' : 'md:float-right' }}">
                                    <!-- Up Handle -->
                                    <x-mzm-html-builder::action-button
                                        wire:click.stop="moveElement('{{ $element['id'] }}', 'up')" :disabled="$loop->first">
                                        <i class="fa-solid fa-arrow-up fa-sm"></i>
                                    </x-mzm-html-builder::action-button>
                                    <!-- Down Handle -->
                                    <x-mzm-html-builder::action-button
                                        wire:click.stop="moveElement('{{ $element['id'] }}', 'down')"
                                        :disabled="$loop->last">
                                        <i class="fa-solid fa-arrow-down fa-sm"></i>
                                    </x-mzm-html-builder::action-button>
                                    <!-- Edit Handle -->
                                    {{-- @if ($element['type'] != 'separator') --}}
                                    <x-mzm-html-builder::action-button color="yellow"
                                        wire:click.stop="editElement('{{ $element['id'] }}')">
                                        <i class="fa-solid fa-pencil fa-sm"></i>
                                    </x-mzm-html-builder::action-button>
                                    {{-- @endif --}}
                                    <!-- Duplicate Handle -->
                                    <x-mzm-html-builder::action-button color="blue"
                                        wire:click.stop="duplicateElement('{{ $element['id'] }}')">
                                        <i class="fa-regular fa-copy fa-sm"></i>
                                    </x-mzm-html-builder::action-button>
                                    <!-- Trash Handle -->
                                    <x-mzm-html-builder::action-button color="red"
                                        x-on:click.stop="confirmDelete('{{ $element['id'] }}')">
                                        <i class="fa-solid fa-trash-can fa-sm"></i>
                                    </x-mzm-html-builder::action-button>
                                </div>
                                <div class="flex-grow">
                                    @switch($element['type'])
                                        @case(ElementType::InputText->value)
                                        @case(ElementType::InputEmail->value)

                                        @case(ElementType::InputNumber->value)
                                        @case(ElementType::InputDate->value)

                                        @case(ElementType::InputTextarea->value)
                                        @case(ElementType::InputSelect->value)

                                        @case(ElementType::InputRadio->value)
                                        @case(ElementType::InputCheckbox->value)
                                            <div wire:key="preview-{{ $element['id'] }}">
                                                @include(
                                                    'mzm-html-builder::livewire.preview.input-wrapper',
                                                    [
                                                        'element' => $element,
                                                        'name' => $element['id'],
                                                    ]
                                                )
                                            </div>
                                        @break

                                        @default
                                            {{-- Untuk elemen yang tidak butuh input seperti button, text-block --}}
                                            @include('mzm-html-builder::livewire.preview.static-element', [
                                                'element' => $element,
                                            ])
                                    @endswitch
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-mzm-html-builder::edit-element-modal :editing-element-data="$editingElementData" :form-elements="$formElements" />
    <x-mzm-html-builder::form-preview-modal :form-title="$formTitle" :form-descriptions="$formDescriptions" :form-elements="$formElements" />
</div>
@script
    <script>
        Alpine.data('formbuilder', () => ({
            showModal: false,
            showPreviewModal: false,
            init() {
                //savedForm
                $wire.on('createdForm', (event) => {
                    Swal.fire('Success', event.message).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = window.location.pathname +
                                '/' +
                                event.formid;
                        }
                    });
                });
                $wire.on('updatedForm', (event) => {
                    Swal.fire('Success', event.message);
                });
            },
            confirmDelete(elementId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //@this.call('deleteElement', elementId);
                        $wire.deleteElement(elementId);
                        // Optional: show a success message
                        Swal.fire('Deleted!', 'The element has been deleted.', 'success')
                    }
                })
            }
        }));
    </script>
@endscript
