<div x-data="formresponses" class="relative flex w-full flex-col md:flex-row">
    <!-- main content  -->
    <div class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
        <!-- Add main content here  -->
        <div class="mx-auto p-4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Form Responses</h1>
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
                <div
                    class="overflow-hidden w-full overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">
                    <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
                        <thead
                            class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                            <tr>
                                <th scope="col" class="p-4">ID</th>
                                <th scope="col" class="p-4">Title</th>
                                <th scope="col" class="p-4">Created At</th>
                                <th scope="col" class="p-4">Elements</th>
                                <th scope="col" class="p-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                            @forelse ($responses as $response)
                                <tr class="even:bg-black/5 dark:even:bg-white/10" wire:key="form-{{ $form->id }}">
                                    <td class="p-4">{{ $form->id }}</td>
                                    <td class="p-4">{{ $form->title }}</td>
                                    <td class="p-4">{{ $form->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="p-4">{{ count($form->elements) }}</td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">


                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-gray-500">
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
        Alpine.data('formresponses', () => ({
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
