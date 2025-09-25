<div class="flex w-full max-w-md flex-col gap-1 text-neutral-600 dark:text-neutral-300">
    <button @foreach ($element['attributes'] as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach>
        {{ $element['label'] }}
    </button>
</div>
