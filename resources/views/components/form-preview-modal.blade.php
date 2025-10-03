@props(['formTitle', 'formDescriptions', 'formElements'])
@php
    use Mzm\HtmlBuilder\Enums\ElementType;
@endphp
<div x-show="showPreviewModal" x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
    x-on:validation-success.window="Swal.fire('Success', event.detail.message, 'success')"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600 flex items-center justify-center z-50"
    x-on:keydown.escape.window="showPreviewModal = false" style="background-color: rgba(0,0,0,0.5);">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-3xl flex flex-col max-h-[90vh]"
        @click.away="showPreviewModal = false">
        {{-- Modal Header --}}
        <div class="px-8 py-4 border-b flex justify-between items-center">
            <div class="grid grid-cols-1 gap-0">
                <h2 class="font-semibold tracking-wide text-onSurfaceStrong dark:text-onSurfaceDarkStrong">
                    {{ $formTitle ?? 'Tiada Title' }}</h2>
                <p>
                    {{ $formDescriptions ?? 'Tiada Description' }}</p>
            </div>
            <button x-on:click="showPreviewModal = false; $wire.resetPreviewValidation()" aria-label="close modal"
                class="p-2 rounded-full hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Modal Body --}}
        <div class="flex-grow overflow-y-auto px-8 py-6">
            @if (empty($formElements))
                <div
                    class="flex flex-col items-center justify-center h-full text-center text-gray-500 border-2 border-dashed border-gray-300 rounded-lg py-24">
                    <i class="fa-solid fa-object-group fa-4x text-gray-400 mb-4 fa-sm"></i>
                    <h3 class="text-xl font-semibold">This Form is Empty</h3>
                    <p class="mt-2">Add some elements to see a preview.</p>
                </div>
            @else
                <form wire:submit.prevent="validatePreview" id="preview-form">
                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($formElements as $element)
                            @php
                                $colspan = $element['colspan'] ?? 4;
                                $name = $element['id'] ?? null;
                            @endphp
                            <div class="mb-1 rounded-lg col-span-{{ $colspan }}">
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
                                            @include('mzm-html-builder::livewire.preview.input-wrapper', [
                                                'element' => $element,
                                                'name' => $name,
                                            ])
                                        </div>
                                    @break

                                    @default
                                        {{-- Untuk elemen yang tidak butuh input seperti button, text-block --}}
                                        @include('mzm-html-builder::livewire.preview.static-element', [
                                            'element' => $element,
                                        ])
                                @endswitch
                            </div>
                        @endforeach
                    </div>
                </form>
            @endif
        </div>

        {{-- Modal Footer --}}
        <div class="flex justify-between items-center px-8 py-4 border-t">
            <button type="button"
                x-on:click="showPreviewModal = false; $wire.resetPreviewValidation();$set('previewData', [])"
                class="px-6 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold">Close</button>
            <div class="flex space-x-4">
                <button type="button" wire:click="$set('previewData', [])"
                    class="px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 font-semibold">Reset
                    Form</button>
                <button type="submit" form="preview-form"
                    class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-semibold">Validate</button>
            </div>
        </div>
    </div>
</div>
