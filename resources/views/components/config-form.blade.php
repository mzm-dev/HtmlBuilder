@props(['authentication', 'grids', 'render'])
<div class="flex w-full flex-col gap-4 text-neutral-600 dark:text-neutral-300">
    <div x-data="{ isExpandedConfigForm: false }"
        class="overflow-hidden rounded-sm border border-neutral-300 bg-neutral-50/40 dark:border-neutral-700 dark:bg-neutral-900/50">
        <button id="controlsAccordionItemOne" type="button"
            class="flex w-full items-center justify-between gap-2 bg-neutral-50 p-4 text-left underline-offset-2 hover:bg-neutral-50/75 focus-visible:bg-neutral-50/75 focus-visible:underline focus-visible:outline-hidden dark:bg-neutral-900 dark:hover:bg-neutral-900/75 dark:focus-visible:bg-neutral-900/75"
            aria-controls="accordionItemOne" x-on:click="isExpandedConfigForm = ! isExpandedConfigForm"
            x-bind:class="isExpandedConfigForm ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold' :
                'text-onSurface dark:text-onSurfaceDark font-medium'"
            x-bind:aria-expanded="isExpandedConfigForm ? 'true' : 'false'">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                Settings
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
                stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
                x-bind:class="isExpandedConfigForm ? 'rotate-180' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
        <div x-cloak x-show="isExpandedConfigForm" id="accordionItemOne" role="region"
            aria-labelledby="controlsAccordionItemOne" x-collapse>
            <div class="p-4 text-sm sm:text-base text-pretty">
                <div class="card">
                    <div class="card-body">

                        <div class="grid grid-cols-2 gap-2 mb-4">

                            <div class="mb-6 border border-gray-800 rounded-sm p-4 shadow-sm w-full">
                                <div class="block text-gray-700 font-semibold mb-2">Layout (Grid)</div>
                                <div class="flex items-center space-x-2">
                                    <input type="number" wire:model.defer="grids.col" min="1" max="12"
                                        class="w-18 h-10 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                    <input type="number" wire:model.defer="grids.gap" min="1" max="4"
                                        class="w-18 h-10 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <p class="text-xs text-gray-500">Exp: grid grid-cols-3 gap-4</p>
                            </div>

                            <div class="mb-6 border border-gray-800 rounded-sm p-4 shadow-sm w-full">
                                <div class="block text-gray-700 font-semibold mb-2">Authentication</div>
                                <div class="flex flex-col mb-3 space-y-3">
                                    <label for="toggleAuth" class="grid grid-cols-2 items-center gap-1">
                                        <input id="toggleAuth" type="checkbox" class="peer sr-only" role="switch"
                                            wire:model.defer="authentication.auth" />
                                        <span
                                            class="trancking-wide text-sm font-medium text-neutral-600 peer-checked:text-neutral-900 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-neutral-300 dark:peer-checked:text-white">Auth
                                            <span class="text-xs text-gray-500">(Only accessible to authenticated
                                                users.)</span></span>
                                        <div class="relative h-6 w-11 after:h-5 after:w-5 peer-checked:after:translate-x-5 rounded-full border border-neutral-300 bg-neutral-50 after:absolute after:bottom-0 after:left-[0.0625rem] after:top-0 after:my-auto after:rounded-full after:bg-neutral-600 after:transition-all after:content-[''] peer-checked:bg-green-500 peer-checked:after:bg-white peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-neutral-800 peer-focus:peer-checked:outline-green-500 peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-neutral-700 dark:bg-neutral-900 dark:after:bg-neutral-300 dark:peer-checked:bg-green-500 dark:peer-checked:after:bg-white dark:peer-focus:outline-neutral-300 dark:peer-focus:peer-checked:outline-green-500"
                                            aria-hidden="true"></div>
                                    </label>
                                    <label for="toggleGuest" class="grid grid-cols-2 items-center gap-1">
                                        <input id="toggleGuest" type="checkbox" class="peer sr-only" role="switch"
                                            wire:model.defer="authentication.guest" />
                                        <span
                                            class="trancking-wide text-sm font-medium text-neutral-600 peer-checked:text-neutral-900 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-neutral-300 dark:peer-checked:text-white">Guest
                                            <span class="text-xs text-gray-500">(Only accessible to unauthenticated
                                                users)</span></span>
                                        <div class="relative h-6 w-11 after:h-5 after:w-5 peer-checked:after:translate-x-5 rounded-full border border-neutral-300 bg-neutral-50 after:absolute after:bottom-0 after:left-[0.0625rem] after:top-0 after:my-auto after:rounded-full after:bg-neutral-600 after:transition-all after:content-[''] peer-checked:bg-green-500 peer-checked:after:bg-white peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-neutral-800 peer-focus:peer-checked:outline-green-500 peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-neutral-700 dark:bg-neutral-900 dark:after:bg-neutral-300 dark:peer-checked:bg-green-500 dark:peer-checked:after:bg-white dark:peer-focus:outline-neutral-300 dark:peer-focus:peer-checked:outline-green-500"
                                            aria-hidden="true"></div>
                                    </label>


                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-center space-y-2 mb-4">

                            <div x-data="{ isExpanded: false }"
                                class="mb-6 border border-gray-800 rounded-sm shadow-sm w-full">
                                <div class="bg-gray-800 p-4 ">
                                    <button id="controlsAccordionItemOne" type="button"
                                        class="flex w-full items-center justify-between gap-4 text-left text-white  underline-offset-2 focus-visible:underline focus-visible:outline-hidden"
                                        aria-controls="accordionItemOne" x-on:click="isExpanded = ! isExpanded"
                                        x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold' :
                                            'text-onSurface dark:text-onSurfaceDark font-medium'"
                                        x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
                                        Before Render Message
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition"
                                            aria-hidden="true" x-bind:class="isExpanded ? 'rotate-180' : ''">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </div>
                                <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region"
                                    aria-labelledby="controlsAccordionItemOne" x-collapse class="pt-2">
                                    <div class="flex flex-col p-4">
                                        <div class="mb-3">
                                            <label for="render.before.title"
                                                class="block text-gray-700 font-semibold mb-2">
                                                Title</label>
                                            <input type="text" wire:model.defer="render.before.title"
                                                id="render.before.title"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="mb-3">
                                            <label for="render.before.body"
                                                class="block text-gray-700 font-semibold mb-2">Body</label>
                                            <textarea wire:model.defer="render.before.body" id="render.before.body"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div x-data="{ isExpanded: false }"
                                class="mb-6 border border-gray-800 rounded-sm shadow-sm w-full">
                                <div class="bg-gray-800 p-4 ">
                                    <button id="controlsAccordionItemOne" type="button"
                                        class="flex w-full items-center justify-between gap-4 text-left text-white  underline-offset-2 focus-visible:underline focus-visible:outline-hidden"
                                        aria-controls="accordionItemOne" x-on:click="isExpanded = ! isExpanded"
                                        x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold' :
                                            'text-onSurface dark:text-onSurfaceDark font-medium'"
                                        x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
                                        After Render Message
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke-width="2" stroke="currentColor" class="size-5 shrink-0 transition"
                                            aria-hidden="true" x-bind:class="isExpanded ? 'rotate-180' : ''">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </div>

                                <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region"
                                    aria-labelledby="controlsAccordionItemOne" x-collapse class="pt-2 bg-white">
                                    <div class="flex flex-col p-4">
                                        <div class="mb-3">
                                            <label for="render.after.title"
                                                class="block text-gray-700 font-semibold mb-2">
                                                Title</label>
                                            <input type="text" wire:model.defer="render.after.title"
                                                id="render.after.title"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="mb-3">
                                            <label for="render.after.body"
                                                class="block text-gray-700 font-semibold mb-2">Body</label>
                                            <textarea wire:model.defer="render.after.body" id="render.after.body"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <div class="block text-gray-700 font-semibold">Redirect To</div>
                                            <p class="text-xs text-gray-500 mb-2">Exp: route('home'), to('/dashboard'),
                                                away('https://www.google.com')</p>
                                            <div class="grid grid-cols-3 gap-2">
                                                <div class="col-span-1 space-y-1">
                                                    <label for="render.after.method"
                                                        class="block text-gray-700 font-normal mb-2">Method</label>
                                                    <select wire:model.defer="render.after.method"
                                                        id="render.after.method"
                                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                                        <option value>--Select-</option>
                                                        <option value="route">Route (Route Name)</option>
                                                        <option value="to">To (URL)</option>
                                                        <option value="away">Away (URL)</option>
                                                    </select>

                                                </div>
                                                <div class="col-span-2 space-y-1">
                                                    <label for="render.after.value"
                                                        class="block text-gray-700 font-normal mb-2">Value</label>
                                                    <input type="text" wire:model.defer="render.after.value"
                                                        id="render.after.value"
                                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
