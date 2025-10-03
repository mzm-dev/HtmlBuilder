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
                                    $inputElements = $this->inputElements->take(3);
                                @endphp
                                @foreach ($inputElements as $key => $item)
                                    <th>{{ Str::words($item, 2) }}</th>
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
                                        <th>{{ Str::words($item, 4, '...') }}</th>
                                    @endforeach
                                    <td class="p-4">{{ $response->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <button type="button"
                                            x-on:click="showResponseDetails({{ json_encode($this->inputElements) }}, '{{ json_encode(collect($response->data)) }}')"
                                            class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">View</button>
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

        <!-- Modal for response details -->
        <div x-show="isModalOpen" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600 flex items-center justify-center z-50"
            x-on:keydown.escape.window="isModalOpen = false" style="background-color: rgba(0,0,0,0.5);">
            <div class="bg-white rounded-lg shadow-2xl w-full max-w-3xl flex flex-col max-h-[90vh]"
                @click.away="isModalOpen = false">
                {{-- Modal Header --}}
                <div class="px-8 py-4 border-b flex justify-between items-center">
                    <div class="grid grid-cols-1 gap-1 mb-2">
                        <h2 class="font-bold text-lg tracking-wide text-onSurfaceStrong dark:text-onSurfaceDarkStrong">
                            {{ $form->title ?? 'Tiada Title' }}</h2>
                        <p class="text-sm text-gray-600">{{ $form->descriptions ?? 'Tiada Description' }}</p>
                    </div>
                    <button x-on:click="isModalOpen = false;" aria-label="close modal"
                        class="p-2 rounded-full hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="flex-grow overflow-y-auto p-6">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <template x-for="([label, value]) in Object.entries(mergeData)" :key="label">
                                <tr>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-400"
                                        x-text="label"></td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white"
                                        x-text="value"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                </div>
                {{-- Modal Footer --}} <div class="flex justify-between items-center px-8 py-4 border-t">
                    <button type="button" x-on:click="isModalOpen = false;"
                        class="px-6 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold">Close</button>

                </div>
            </div>
        </div>

    </div>
</div>

@script
    <script>
        Alpine.data('formlist', () => ({
            isModalOpen: false,
            // mergeData akan menjadi objek: { 'Nama Penuh': 'eee', 'E-mel Pemohon': 'mohdzaki04@gmail.com', ... }
            mergeData: {},

            formatValue(value) {
                if (typeof value === 'boolean') {
                    return value ? 'Ya' : 'Tidak'; // Terjemahkan boolean
                }
                if (value === null || value === undefined) {
                    return '-';
                }
                return String(value); // Pastikan nilai lain dipaparkan sebagai string
            },

            showResponseDetails(labels, valuesJsonString) {
                // 1. Parsing JSON String dari PHP/Livewire ke Objek JavaScript
                const values = JSON.parse(valuesJsonString);

                // 2. Menggabungkan data dari 'labels' dan 'values'
                //    dan menukar array objek [{label, value}] kepada objek tunggal {label: value}
                const combinedData = Object.keys(labels).reduce((acc, key) => {
                    // Hanya gabungkan jika kunci wujud dalam kedua-dua set data
                    if (key in values) {
                        // Gunakan label sebagai kunci objek baharu
                        acc[labels[key]] = this.formatValue(values[key]);
                    }
                    return acc;
                }, {});

                // 3. Set data untuk modal dan buka modal
                this.mergeData = combinedData;
                this.isModalOpen = true;
            },
        }));
    </script>
@endscript
