<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import type { Component } from "vue";

// defineProps now accepts individual properties
withDefaults(defineProps<{
    label: string;
    loadingLabel?: string;
    isLoading?: boolean;
    isWide?: boolean;
    icon?: Component;
    href?: string;
}>(), {
    isLoading: false,
    isWide: false,
    href: undefined,
});
</script>

<template>
    <Link
        v-if="href"
        :href="href"
        class="btn btn-primary"
        :class="{ 'w-full': isWide, 'opacity-50 pointer-events-none': isLoading }"
    >
        <span v-if="isLoading" class="loading loading-spinner"></span>

        {{ isLoading && loadingLabel ? loadingLabel : label }}

        <component
            :is="icon"
            v-if="icon"
            class="h-5 w-5 shrink-0 ml-2"
        />
    </Link>

    <button
        v-else
        class="btn btn-primary"
        :class="{ 'w-full': isWide }"
        :disabled="isLoading"
    >
        <span v-if="isLoading" class="loading loading-spinner"></span>

        {{ isLoading && loadingLabel ? loadingLabel : label }}

        <component
            :is="icon"
            v-if="icon"
            class="h-5 w-5 shrink-0 ml-2"
        />
    </button>
</template>