@props(['editingElementData', 'formElements' => [], 'rules' => []])

<div class="flex w-full flex-col gap-4 text-neutral-600 dark:text-neutral-300 mb-2">
    @php
        // Periksa apakah ada aturan validasi yang aktif (bukan false atau null)
        $hasActiveRules = collect($editingElementData['validation'] ?? [])->filter(function ($value) {
            return $value !== false && $value !== null;
        })->isNotEmpty();
    @endphp
    <div x-data="{ isExpanded: @json($hasActiveRules) }"
        class="overflow-hidden rounded-sm border border-neutral-300 bg-neutral-50/40 dark:border-neutral-700 dark:bg-neutral-900/50">
        <button id="controlsAccordionRules" type="button"
            class="flex w-full items-center justify-between gap-2 bg-neutral-50 p-4 text-left underline-offset-2 hover:bg-neutral-50/75 focus-visible:bg-neutral-50/75 focus-visible:underline focus-visible:outline-hidden dark:bg-neutral-900 dark:hover:bg-neutral-900/75 dark:focus-visible:bg-neutral-900/75"
            aria-controls="accordionStyle" x-on:click="isExpanded = ! isExpanded"
            x-bind:class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold' :
                'text-onSurface dark:text-onSurfaceDark font-medium'"
            x-bind:aria-expanded="isExpanded ? 'true' : 'false'">
            Rules
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
                stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
                x-bind:class="isExpanded ? 'rotate-180' : ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
        <div x-cloak x-show="isExpanded" id="accordionStyle" role="region" aria-labelledby="controlsAccordionRules"
            x-collapse>
            <div class="p-4 space-y-4"> {{-- Added space-y-4 for better spacing between dynamic rule components --}}
                @foreach ($rules as $rule)
                    @php
                        $ruleComponent = 'mzm-html-builder::options.rules.' . $rule;
                    @endphp
                    <x-dynamic-component :component="$ruleComponent" :editingElementData="$editingElementData" :formElements="$formElements" />
                @endforeach
            </div>
        </div>
    </div>
</div>
