import { defineStore } from "pinia";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

export const useSideBarStore = defineStore("sidebar", () => {
    const isOpen = ref(true);

    function sideBarHover(): void {
        isOpen.value = !isOpen.value;
    }

    function normalize(path: string): string {
        return new URL(path, window.location.origin).pathname;
    }

    function hasActiveRoutes(route: string | undefined): boolean {
        if (!route) return false;

        const page = usePage();
        return normalize(route) === normalize(page.url);
    }

    function hasActiveChildRoutes(routes: string[]): boolean {
        const page = usePage();
        const currentPath = normalize(page.url);

        return routes.some((r) => {
            if (!r) return false;
            return currentPath.startsWith(normalize(r));
        });
    }

    return {
        isOpen,
        sideBarHover,
        hasActiveRoutes,
        hasActiveChildRoutes,
    };
});
