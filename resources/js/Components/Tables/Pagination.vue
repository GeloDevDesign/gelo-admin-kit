<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

interface LinkItem {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginationData {
    current_page: number;
    last_page: number;
    links: LinkItem[];
    total: number;
}

defineProps<{
    data: PaginationData;
}>();
</script>

<template>
    <div
        class="mt-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
    >
        <div class="text-sm text-gray-600 text-center sm:text-left">
            Showing page {{ data.current_page }} of {{ data.last_page }}
            <span class="font-semibold">({{ data.total }} total items)</span>
        </div>

        <div class="join flex flex-wrap justify-center sm:justify-end">
            <Link
                v-for="link in data.links"
                :key="link.label"
                :href="link.url || '#'"
                preserve-state
                preserve-scroll
                class="join-item btn font-normal"
                :class="{
                    'btn-primary': link.active,
                    'btn-disabled font-bold text-black': !link.url,
                    'bg-base-100': !link.active && link.url,
                }"
                v-html="link.label"
            />
        </div>
    </div>
</template>
