<script setup lang="ts">
import type { Component } from 'vue';

// 1. Interface: PascalCase (Standard for types)
interface ButtonConfig {
    label: string;
    loadingLabel?: string;
    isLoading?: boolean;
    isWide?: boolean;
    icon?: Component; // Changed from 'string' to 'Component'
}

// 2. Prop: camelCase (Renamed 'buttonConfig' to 'config' to avoid redundancy)
defineProps<{
    config: ButtonConfig;
}>();
</script>

<template>
    <button class="btn" :disabled="config.isLoading">
        <span
            v-if="config.isLoading"
            class="loading loading-spinner"
        ></span>

        {{
            config.isLoading && config.loadingLabel
                ? config.loadingLabel
                : config.label
        }}

        <component
            :is="config.icon"
            v-if="config.icon"
            class="h-5 w-5 shrink-0 ml-2" 
        />
    </button>
</template>