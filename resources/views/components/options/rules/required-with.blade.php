@props(['editingElementData', 'formElements' => []])

<div class="mb-4 p-4 border border-gray-200 rounded-md dark:border-gray-700">
    <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-3">Required With</label>
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">The field under validation must be present and not empty
        only if
        any of the other specified fields are present.</p>
    <div class="space-y-2 max-h-40 overflow-y-auto">
        @foreach ($formElements as $key => $element)
            @if (
                $element['id'] !== $editingElementData['id'] &&
                    in_array($element['type'], [
                        'text-input',
                        'number-input',
                        'email',
                        'textarea-input',
                        'date',
                        'select-input',
                        'radio-buttons',
                        'checkbox-buttons',
                    ]))
                <label for="chk-{{ $element['id'] }}-{{ $key }}"
                    class="flex items-center gap-2 text-sm font-medium text-neutral-600 dark:text-neutral-300 has-checked:text-neutral-900 dark:has-checked:text-white has-disabled:cursor-not-allowed has-disabled:opacity-75">
                    <span class="relative flex items-center">
                        <input id="chk-{{ $element['id'] }}-{{ $key }}" type="checkbox"
                            value="{{ $element['id'] }}" wire:model.defer="editingElementData.validation.required_with" x-init="$wire.editingElementData.validation.required_with = $wire.editingElementData.validation.required_with ?? []"
                            class="before:content[''] peer relative size-4 appearance-none overflow-hidden rounded border border-neutral-300 bg-neutral-50 before:absolute before:inset-0 checked:border-black checked:before:bg-black focus:outline-2 focus:outline-offset-2 focus:outline-neutral-800 checked:focus:outline-black active:outline-offset-0 disabled:cursor-not-allowed dark:border-neutral-700 dark:bg-neutral-900 dark:checked:border-white dark:checked:before:bg-white dark:focus:outline-neutral-300 dark:checked:focus:outline-white" />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="4"
                            class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-neutral-100 peer-checked:visible dark:text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </span>
                    <span>{{ $element['label'] }} (<code>{{ $element['id'] }}</code>)</span>
                </label>
            @endif
        @endforeach
    </div>
</div>
