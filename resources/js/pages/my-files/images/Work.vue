<script setup lang="ts">
import Layout from "../../../shared/ui/Layout.vue";
import { Head } from "@inertiajs/vue3";

defineOptions({ layout: Layout });
</script>

<template>
    <Head title="Work.png" />
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Work.png</h1>
        <div class="card w-96 bg-base-100 shadow-xl">
            <figure><div class="w-full h-48 bg-secondary/20 flex items-center justify-center">Image Preview</div></figure>
            <div class="card-body">
                <h2 class="card-title">Work Screenshot</h2>
                <p>Important work related screenshot.</p>
            </div>
        </div>
    </div>
</template>
