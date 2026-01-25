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
    <div class="flex gap-3 justify-between rounded-lg">
        <div class="flex gap-2 w-full">
            <label class="input flex-1 max-w-[400px]">
                <Search class="h-[1em] opacity-50" />
                <input type="search" class="grow" />
            </label>
            <div class="space-x-2">
                <button class="btn btn-error btn-soft">Reset</button>
                <button class="btn btn-primary btn-soft">Search</button>
            </div>
        </div>
        <div class="w-full flex justify-end">
            <form>
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
