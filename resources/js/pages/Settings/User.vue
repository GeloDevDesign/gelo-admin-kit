<script setup lang="ts">
import Layout from "../../shared/ui/Layout.vue";
import { Head } from "@inertiajs/vue3";

defineOptions({ layout: Layout });
</script>

<template>
    <Head title="User Settings" />
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">User Settings</h1>
        <p>Manage your user profile and account settings here.</p>
    </div>
</template>
