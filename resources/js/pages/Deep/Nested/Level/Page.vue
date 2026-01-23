<script setup lang="ts">
import AuthLayout from "@/layouts/AuthLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Deep Nested Page" />
    <AuthLayout title="Deep Nested Page" description="This page exists to verify the breadcrumbs functionality.">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Deep Nested Breadcrumb Test</h1>
            <p class="mb-4">This page exists to verify the breadcrumbs functionality.</p>
            <div class="alert alert-info">
                <p>Check the breadcrumbs above. It should read: <strong>Home > Deep > Nested > Level > Page</strong></p>
            </div>
        </div>
    </AuthLayout>
</template>
