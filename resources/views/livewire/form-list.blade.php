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
                <div
                    class="overflow-hidden w-full overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">
                    <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
                        <thead
                            class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                            <tr>
                                <th scope="col" class="p-4">ID</th>
                                <th scope="col" class="p-4">Title</th>
                                <th scope="col" class="p-4 text-center">Elements</th>
                                <th scope="col" class="p-4 text-center">Responses</th>
                                <th scope="col" class="p-4">Created At</th>
                                <th scope="col" class="p-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                            @forelse ($forms as $form)

                                <tr class="even:bg-black/5 dark:even:bg-white/10" wire:key="form-{{ $form->id }}">
                                    <td class="p-4">
                                        {{ $forms->firstItem() + $loop->index }}
                                    </td>
                                    <td class="p-4">{{ Str::words($form->title, 5) }}</td>

                                    <td class="p-4 text-center">{{ count($form->elements) }}</td>
                                    <td class="p-4 flex items-center justify-center">
                                        <a href="{{ count($form->response) ? route('form-builder.response-list', $form->id) : 'javascript:void(0);' }} "
                                            class="whitespace-nowrap rounded-sm bg-transparent p-0.5 font-semibold {{ count($form->response) ? 'text-purple-600 outline-purple-600 dark:text-purple-400 dark:outline-purple-400' : 'text-gray-400 outline-gray-400 dark:text-gray-600 dark:outline-gray-600' }} hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0">
                                            <span>{{ count($form->response) }}</span>
                                        </a>
                                    </td>

                                    <td class="p-4">{{ $form->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <a target="_blank" href="{{ route('form-builder.response', $form->id) }}"
                                            class="whitespace-nowrap rounded-sm bg-transparent p-0.5 font-semibold text-green-600 outline-green-600 hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-green-400 dark:outline-blue-400">
                                            New Response
                                        </a>
                                        <a href="{{ route('form-builder.form', $form->id) }}"
                                            class="whitespace-nowrap rounded-sm bg-transparent p-0.5 font-semibold text-blue-600 outline-blue-600 hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-blue-400 dark:outline-blue-400">
                                            Edit
                                        </a>
                                        <button type="button" x-on:click="confirmDelete('{{ $form->id }}')"
                                            class="whitespace-nowrap rounded-sm bg-transparent p-0.5 font-semibold text-red-600 outline-red-600 hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-red-400 dark:outline-red-400">
                                            Delete
                                        </button>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-gray-500">
                                        No forms found.
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
