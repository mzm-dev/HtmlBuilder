<div x-data="{
    init() {
        if (this.$refs.input.dataset.format) {
            flatpickr(this.$refs.input, {
                dateFormat: this.$refs.input.dataset.format,
            });
        }
    }
}" class="flex w-full max-w flex-col gap-1 text-neutral-600 dark:text-neutral-300">
    <x-mzm-html-builder::elements.label :element="$element" />
    <input x-ref="input" type="date"
        placeholder="{{ $element['placeholder'] ?? '' }}" data-format="{{ $element['format'] ?? '' }}"
        class="w-full rounded-sm border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
</div>
