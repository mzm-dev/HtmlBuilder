@props(['element', 'wireModel' => null])
@php
    $classes = $element['attributes']['class'] ?? '';
@endphp
<div class="{{$classes}} flex flex-col gap-2">
    <x-mzm-html-builder::elements.label :element="$element" />
    @foreach ($element['options'] as $key => $option)
        <label for="chk-{{ $element['id'] }}-{{ $key }}"
            class="flex items-center gap-2 text-sm font-medium text-neutral-600 dark:text-neutral-300 has-checked:text-neutral-900 dark:has-checked:text-white has-disabled:cursor-not-allowed has-disabled:opacity-75">
            <span class="relative flex items-center">
                <input id="chk-{{ $element['id'] }}-{{ $key }}" type="checkbox"
                    class="before:content[''] peer relative size-4 appearance-none overflow-hidden rounded border border-neutral-300 bg-neutral-50 before:absolute before:inset-0 checked:border-black checked:before:bg-black focus:outline-2 focus:outline-offset-2 focus:outline-neutral-800 checked:focus:outline-black active:outline-offset-0 disabled:cursor-not-allowed dark:border-neutral-700 dark:bg-neutral-900 dark:checked:border-white dark:checked:before:bg-white dark:focus:outline-neutral-300 dark:checked:focus:outline-white"
                @if ($wireModel) wire:model.lazy="{{ $wireModel }}" @endif />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="4"
                    class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-neutral-100 peer-checked:visible dark:text-black">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </span>
            <span>{{ $option['label'] }}</span>
        </label>
    @endforeach

</div>
<x-mzm-html-builder::elements.help-text :element="$element" />
