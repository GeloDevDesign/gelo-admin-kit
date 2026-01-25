<script setup lang="ts">
import AuthLayout from "@/layouts/AuthLayout.vue";
import { Plus } from "lucide-vue-next";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import Filter from "@/Components/Filter.vue";
import Table from "@/Components/Tables/Table.vue";
</script>

<template>
    <AuthLayout
        title="Dashboard"
        description="This is where you will see all the analytics"
    >
        <template #actions>
            <PrimaryButton label="Add New Product" :icon="Plus" />
        </template>
        <template #filters>
            <Filter />
        </template>

        <Table />
    </AuthLayout>
</template>
