<script setup lang="ts">
import { Search } from "lucide-vue-next";

import { Home } from "lucide-vue-next";

interface FilterConfig {
    items: (string | number)[];
    enabled: boolean;
}

// 1. Add '?' to make the prop optional
// 2. Use withDefaults to provide the fallback data
withDefaults(
    defineProps<{
        filterConfig?: FilterConfig;
    }>(),
    {
        // Object defaults must be returned by a function
        filterConfig: () => ({
            items: [],
            enabled: false,
        }),
    },
);
</script>

<template>
    <div class="flex flex-col lg:flex-row gap-4 justify-between rounded-lg">
        <div class="flex flex-col sm:flex-row gap-2 w-full lg:w-auto lg:flex-1">
            <label class="input w-full sm:max-w-[400px]">
                <Search class="h-[1em] opacity-50" />
                <input type="search" class="grow" placeholder="Search" />
            </label>
            <div class="grid grid-cols-2 sm:flex gap-2">
                <button class="btn btn-error btn-soft">Reset</button>
                <button class="btn btn-primary btn-soft">Search</button>
            </div>
        </div>
        <div class="w-full lg:w-auto flex justify-start lg:justify-end overflow-x-auto pb-2 lg:pb-0">
            <form class="flex gap-1 min-w-max">
                <input
                    class="btn"
                    type="checkbox"
                    name="frameworks"
                    aria-label="Svelte"
                />
                <input
                    class="btn"
                    type="checkbox"
                    name="frameworks"
                    aria-label="Vue"
                />
                <input
                    class="btn"
                    type="checkbox"
                    name="frameworks"
                    aria-label="React"
                />
                <input class="btn btn-square" type="reset" value="×" />
            </form>
        </div>
    </div>
</template>
