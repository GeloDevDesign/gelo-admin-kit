<script setup lang="ts">
import { Search } from "lucide-vue-next";

interface FilterConfig {
    items: (string | number)[];
    enabled: boolean;
}

defineProps<{
    filterConfig: FilterConfig;
}>();

</script>

<template>
    <div class="flex flex-wrap gap-3">
        <label v-for="i in 5" :key="i" class="input flex-1 min-w-[200px]">
            <Search class="h-[1em] opacity-50" />
            <input type="search" class="grow" placeholder="Search" />
        </label>
        <div class="space-x-2"> 
          <button class="btn btn-error btn-soft">Reset</button>
          <button class="btn btn-primary btn-soft">Search</button>
        </div>
    </div>
</template>
