<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import SidebarItem from "@/Components/SidebarItem.vue";
import { useSideBarStore } from "@/Stores/sidebar";
import { MenuItem } from "@/types";

const sidebar = useSideBarStore();
const childrenRoutes = ref<string[]>([]);

const props = defineProps<{ item: MenuItem }>();

const childRoutes = computed<string[]>(() => {
    if (!props.item.children) return [];

    return props.item.children
        .map((child) => child.route)
        .filter((route) => route !== undefined);
});

const isOpen = computed(() => {
    return sidebar.hasActiveChildRoutes(childRoutes.value);
});


</script>

<template>
    <li
        class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
        :data-tip="item.label"
    >
        <!-- HAS CHILDREN -->
        <details v-if="item.children" :open="isOpen">
            <summary
                class="is-drawer-close:after:hidden"
                :class="
                    isOpen
                        ? 'text-primary font-medium text-sm'
                        : 'text-sm opacity-60'
                "
            >
                <!-- {{ item }} -->
                <component
                    :is="item.icon"
                    v-if="item.icon"
                    class="h-5 w-5 shrink-0"
                />
                <span class="is-drawer-close:hidden">
                    {{ item.label }}
                </span>
            </summary>

            <ul class="is-drawer-close:hidden">
                <SidebarItem
                    v-for="child in item.children"
                    :key="child.label"
                    :item="child"
                />
            </ul>
        </details>

        <Link
            :href="item?.route"
            v-else
            class="is-drawer-close:after:hidden"
            :class="
                sidebar.hasActiveRoutes(item?.route)
                    ? 'text-primary '
                    : 'opacity-60'
            "
        >
            <component
                :is="item.icon"
                v-if="item.icon"
                class="h-5 w-5 shrink-0"
            />
            <span class="is-drawer-close:hidden">
                {{ item.label }}
            </span>
        </Link>
    </li>
</template>
