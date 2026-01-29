<script setup lang="ts">
import { Command } from 'lucide-vue-next';
</script>

<template>
    <div class="min-h-screen bg-base-200 flex flex-col items-center justify-center p-4">
        <div class="mb-8 flex flex-col items-center gap-2">
            <div class="bg-primary p-3 rounded-xl text-primary-content shadow-lg">
                <Command class="size-6" />
            </div>
            <h1 class="text-lg font-bold tracking-tight">Admin Kit</h1>
        </div>

        <div class="card w-full max-w-md shadow-2xl bg-base-100">
            <div class="card-body">
                <slot />
            </div>
        </div>

        <div class="mt-8 text-center text-sm opacity-50">
            <p>&copy; GeloCodes</p>
        </div>
    </div>
</template>
