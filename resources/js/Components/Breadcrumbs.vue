<script setup lang="ts">
import { computed } from "vue";
import { usePage, Link } from "@inertiajs/vue3";

interface Breadcrumb {
    label: string;
    url: string | null;
}

const page = usePage();

const breadcrumbs = computed<Breadcrumb[]>(() => {
    return (page.props.breadcrumbs as Breadcrumb[]) || [];
});
</script>

<template>
    <div class="breadcrumbs text-sm px-4">
        <ul>
            <li v-for="(crumb, index) in breadcrumbs" :key="index">
                <!-- Last item (url is null) is not a link -->
                <span
                    v-if="!crumb.url"
                    class="font-semibold text-primary"
                    >{{ crumb.label }}</span
                >
                <Link v-else :href="crumb.url">{{ crumb.label }}</Link>
            </li>
        </ul>
    </div>
</template>
