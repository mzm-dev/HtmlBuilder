<div x-data="formlist" class="relative flex w-full flex-col md:flex-row">
    <!-- main content  -->
    <div class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
        <!-- Add main content here  -->
        <div class="mx-auto p-4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Form List</h1>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg mb-6">
                <div class="overflow-hidden w-full overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">

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
