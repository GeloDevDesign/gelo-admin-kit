<script setup lang="ts">
import AuthLayout from "@/layouts/AuthLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Plus } from "lucide-vue-next";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import Filter from "@/Components/Filter.vue";
import Table from "@/Components/Tables/Table.vue";
</script>

<template>
    <Head title="User Management" />
    <AuthLayout
        title="User Management"
        description="Manage your users and their roles here."
    >
        <template #actions>
            <PrimaryButton label="Add New Product" :icon="Plus" />
        </template>
        <template #filters>
            <Filter
                :has-search="true"
                :has-user-type="true"
                :data-user-role="[
                    { label: 'Admin', value: 'admin' },
                    { label: 'User', value: 'user' },
                ]"
                :has-status="true"
                :has-date="true"
            />
        </template>

        <Table />
    </AuthLayout>
</template>
