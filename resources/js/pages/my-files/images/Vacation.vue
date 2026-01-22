<script setup lang="ts">
import Layout from "../../../shared/ui/Layout.vue";
import { Head } from "@inertiajs/vue3";

defineOptions({ layout: Layout });
</script>

<template>
    <Head title="Vacation.png" />
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Vacation.png</h1>
        <div class="card w-96 bg-base-100 shadow-xl">
            <figure><div class="w-full h-48 bg-primary/20 flex items-center justify-center">Image Preview</div></figure>
            <div class="card-body">
                <h2 class="card-title">Vacation Photo</h2>
                <p>A nice photo from the trip.</p>
            </div>
        </div>
    </div>
</template>
