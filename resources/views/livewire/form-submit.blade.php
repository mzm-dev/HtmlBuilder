@section('title', $form->title ?? 'Form Builder MZM')

@php
    use Mzm\HtmlBuilder\Enums\ElementType;
@endphp
<div x-data="formsubmit">

    @if ($form)
        <form wire:submit="save" class="max-w-5xl mx-auto m-4 p-4 bg-white border border-gray-100 shadow-md rounded-lg">
            <div class="grid grid-cols-{{ $grids['col'] }} gap-{{ $grids['gap'] }}">
                @foreach ($fields as $field)
                    @php
                        $colspan = $field['colspan'] ?? 4;
                        $name = $field['id'] ?? null;
                    @endphp
                    <div class="mb-1 rounded-lg col-span-{{ $colspan }}">
                        @switch($field['type'])
                            @case(ElementType::InputText->value)
                            @case(ElementType::InputEmail->value)

                            @case(ElementType::InputNumber->value)
                            @case(ElementType::InputDate->value)

                            @case(ElementType::InputTextarea->value)
                            @case(ElementType::InputSelect->value)

                            @case(ElementType::InputRadio->value)
                            @case(ElementType::InputCheckbox->value)
                                @if ($name)
                                    <div wire:key="input-{{ $field['id'] }}">
                                        @include('mzm-html-builder::livewire.preview.input-wrapper', [
                                            'data' => 'responses',
                                            'element' => $field,
                                            'name' => $name,
                                        ])
                                    </div>
                                @else
                                    {{-- Render elemen tanpa binding jika tidak ada 'name' --}}
                                    @include('mzm-html-builder::livewire.preview.static-element', [
                                        'data' => 'responses',
                                        'element' => $field,
                                    ])
                                @endif
                            @break

                            @default
                                {{-- Untuk elemen yang tidak butuh input seperti button, text-block --}}
                                @include('mzm-html-builder::livewire.preview.static-element', [
                                    'data' => 'responses',
                                    'element' => $field,
                                ])
                        @endswitch
                    </div>
                @endforeach
            </div>
        </form>
    @else
        <p>Borang tidak ditemui.</p>
    @endif
</div>

@script
    <script>
        //savedForm
        Livewire.on('render-before', (event) => {
            setTimeout(() => {
                Swal.fire(event.title, event.body);
            }, 500);
        });
        Alpine.data('formsubmit', () => ({
            init() {
                $wire.on('render-after', (event) => {
                    Swal.fire(event.title, event.body).then((result) => {
                        if (result.isConfirmed) {
                            $wire.redirectTo();
                        }
                    });
                });

            },
        }));
    </script>
@endscript
