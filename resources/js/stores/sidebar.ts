import { defineStore } from "pinia";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

export const useSideBarStore = defineStore("sidebar", () => {
    const isOpen = ref<boolean>(false);

    function sideBarHover(): void {
        isOpen.value = !isOpen.value;
    }

    function hasChildActiveRoutes(routes: string[]): boolean {
        const page = usePage();
        return routes.some((route) => page.url === route);
    }

    function hasActiveRoutes(route: string): boolean {
        const page = usePage();
        return page.url === route;
    }

    return {
        isOpen,
        sideBarHover,
        hasChildActiveRoutes,
        hasActiveRoutes,
    };
});
