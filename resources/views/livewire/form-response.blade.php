@php
    use Illuminate\Support\Str;
@endphp
<div x-data="formlist" class="relative flex w-full flex-col md:flex-row">
    <!-- main content  -->
    <div class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
        <!-- Add main content here  -->
        <div class="mx-auto p-4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Form List</h1>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg mb-6">

                <div class="grid grid-cols-1 gap-1 mb-2">
                    <h2 class="font-bold text-lg tracking-wide text-onSurfaceStrong dark:text-onSurfaceDarkStrong">
                        {{ $form->title ?? 'Tiada Title' }}</h2>
                    <p class="text-sm text-gray-600">{{ $form->descriptions ?? 'Tiada Description' }}</p>
                </div>
                <div
                    class="overflow-hidden w-full overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">
                    <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
                        <thead
                            class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                            <tr>
                                <th scope="col" class="p-4">ID</th>
                                @php
                                    $inputElements = collect($form->elements)
                                        ->filter(fn($el) => Str::startsWith($el['type'], 'input-'))
                                        ->take(3);
                                @endphp
                                @foreach ($inputElements as $item)
                                    <th>{{ Str::words($item['label'], 2) }}</th>
                                @endforeach
                                <th scope="col" class="p-4">Created At</th>
                                <th scope="col" class="p-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                            @forelse ($responses as $response)
                                {{-- {{ json_encode($formInputElements) }} --}}
                                <tr class="even:bg-black/5 dark:even:bg-white/10" wire:key="form-{{ $form->id }}">
                                    <td class="p-4">
                                        {{ $responses->firstItem() + $loop->index }}
                                    </td>
                                    @php
                                        $data = collect($response->data)->take(3);
                                    @endphp
                                    @foreach ($data as $item)
                                        <th>{{ Str::words($item, 4,'...') }}</th>
                                    @endforeach
                                    <td class="p-4">{{ $response->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-gray-500">
                                        No responses found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@script
    <script>
        Alpine.data('formlist', () => ({
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
                        $wire.deleteForm(elementId);
                        // Optional: show a success message
                        // Swal.fire('Deleted!', 'The element has been deleted.', 'success')
                        $wire.on('deletedForm', (event) => {
                            Swal.fire('Success', event.message);
                        });
                    }
                })
            }
        }));
    </script>
@endscript
