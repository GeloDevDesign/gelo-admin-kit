<script setup lang="ts">
import { ref, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";
import SidebarItem from "@/Components/SidebarItem.vue";
import { useSideBarStore } from "@/Stores/sidebar";

const sidebar = useSideBarStore();
const childrenRoutes = ref<string[]>([]);

export interface MenuItem {
    label: string;
    icon?: any;
    toolTipName?: string;
    children?: MenuItem[];
    isOpen?: boolean;
    routeName?: string;
    href?: string;
}

const props = defineProps<{ item: MenuItem }>();

function getAllChildrenRoutes(item: MenuItem): string[] {
    let routes: string[] = [];

    if (item.children) {
        for (const child of item.children) {
            if (child.href) routes.push(child.href);

            if (child.children) {
                routes = routes.concat(getAllChildrenRoutes(child));
            }
        }
    }

    return routes;
}

onMounted(() => {
    childrenRoutes.value = getAllChildrenRoutes(props.item);
});
</script>

<template>
    <li
        class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
        :data-tip="item.label"
    >
        <!-- HAS CHILDREN -->
        <details
            v-if="item.children"
            :open="sidebar.hasChildActiveRoutes(childrenRoutes)"
        >
            <summary
                class="is-drawer-close:after:hidden"
                :class="
                    sidebar.hasChildActiveRoutes(childrenRoutes)
                        ? 'text-primary font-medium text-sm'
                        : 'text-sm opacity-60'
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
            :href="item.href"
            v-else
            class="is-drawer-close:after:hidden"
            :class="
                sidebar.hasActiveRoutes(item?.href || '')
                    ? 'text-primary '
                    : 'opacity-60'
            "
        >
            <span class="is-drawer-close:hidden">
                {{ item.label }}
            </span>
        </Link>
    </li>
</template>
