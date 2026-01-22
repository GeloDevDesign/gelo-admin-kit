<script setup lang="ts">
import Layout from "../../shared/ui/Layout.vue";
import { Head } from "@inertiajs/vue3";

defineOptions({ layout: Layout });
</script>

<template>
    <Head title="Resume.pdf" />
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Resume.pdf</h1>
        <div class="mockup-window border bg-base-300 w-full max-w-4xl h-96">
            <div class="flex justify-center px-4 py-16 bg-base-200 h-full">PDF Content Preview</div>
        </div>
    </div>
</template>
