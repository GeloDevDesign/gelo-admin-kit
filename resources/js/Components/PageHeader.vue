<script setup lang="ts">
defineProps<{
    title: string;
    description?: string;
}>();
</script>

<template>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-base-content">{{ title }}</h1>
        <p v-if="description" class="text-base-content/50 mt-1 text-sm">
            {{ description }}
        </p>
    </div>
</template>
