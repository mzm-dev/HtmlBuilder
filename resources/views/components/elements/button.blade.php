<button @foreach ($element['attributes'] as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach>
    {{ $element['label'] }}
</button>
