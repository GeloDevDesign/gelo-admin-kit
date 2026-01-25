<script setup lang="ts">
import type { Component } from "vue";

// defineProps now accepts individual properties
withDefaults(defineProps<{
    label: string;
    loadingLabel?: string;
    isLoading?: boolean;
    isWide?: boolean;
    icon?: Component;
}>(), {
    isLoading: false,
    isWide: false
});
</script>

<template>
    <button class="btn btn-primary" :disabled="isLoading">
        <span v-if="isLoading" class="loading loading-spinner"></span>

        {{ isLoading && loadingLabel ? loadingLabel : label }}

        <component
            :is="icon"
            v-if="icon"
            class="h-5 w-5 shrink-0 ml-2"
        />
    </button>
</template>