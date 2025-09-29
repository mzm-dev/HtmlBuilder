<div x-data="formlist" class="relative flex w-full flex-col md:flex-row">
    <!-- main content  -->
    <div class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
        <!-- Add main content here  -->
        <div class="mx-auto p-4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Form List</h1>
            </div>
            <div class="grid grid-cols-12 gap-x-5">
                <div class="col-span-12 md:col-span-3 xxl:col-span-3">
                    <div
                        class="group flex rounded-sm w-full max-w-xs flex-col overflow-hidden shadow-md border border-neutral-300 bg-neutral-50  p-6 text-neutral-600 dark:border-white dark:bg-neutral-900 dark:text-neutral-300">
                        <div class="flex space-x-4 rtl:space-x-reverse">
                            <div class="flex items-center justify-center ecommerce-icon px-0 bg-amber-50">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-12">
                                    <path fill-rule="evenodd"
                                        d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                </svg>

                            </div>
                            <div class="">
                                <div class="mb-2">Total Forms</div>
                                <div class="text-gray-500 dark:text-white/70 mb-1 text-xs">
                                    <span
                                        class="text-gray-800 font-semibold text-xl leading-none align-bottom dark:text-white">
                                        {{ $forms ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-3 xxl:col-span-3">
                    <div
                        class="group flex rounded-sm w-full max-w-xs flex-col overflow-hidden shadow-md border border-neutral-300 bg-neutral-50  p-6 text-neutral-600 dark:border-white dark:bg-neutral-900 dark:text-neutral-300">
                        <div class="flex space-x-4 rtl:space-x-reverse">
                            <div class="flex items-center justify-center ecommerce-icon px-0 bg-amber-50">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-12">
                                    <path fill-rule="evenodd"
                                        d="M19.5 21a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3h-5.379a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H4.5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h15Zm-6.75-10.5a.75.75 0 0 0-1.5 0v4.19l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V10.5Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </div>
                            <div class="">
                                <div class="mb-2">Total Responses</div>
                                <div class="text-gray-500 dark:text-white/70 mb-1 text-xs"> <span
                                        class="text-gray-800 font-semibold text-xl leading-none align-bottom dark:text-white">
                                        {{ $responses ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
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
