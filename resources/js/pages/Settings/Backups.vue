<script setup lang="ts">
import Layout from "../../shared/ui/Layout.vue";
import { Head } from "@inertiajs/vue3";

defineOptions({ layout: Layout });
</script>

<template>
    <Head title="Backups" />
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Backups</h1>
        <p>Manage system backups and restoration points.</p>
    </div>
</template>
