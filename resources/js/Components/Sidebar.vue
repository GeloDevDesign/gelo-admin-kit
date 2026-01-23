<script setup lang="ts">
import SidebarItem, { type MenuItem } from "@/Components/SidebarItem.vue";
import {
    Home,
    Settings,
    User,
    Sliders,
    Database,
    FileText,
    Image,
    LogOut,
} from "lucide-vue-next";
import Swal from "sweetalert2";
import { router } from "@inertiajs/vue3";
import { useSideBarStore } from "@/Stores/sidebar";

const sidebar = useSideBarStore();

interface MenuSection {
    title?: string;
    items: MenuItem[];
}

const menuSections: MenuSection[] = [
    {
        items: [
            {
                label: "Homepage",
                icon: Home,
                routeName: "home",
                href: "/",
            },
        ]
    },
    {
        title: "User Management",
        items: [
            {
                label: "Settings",
                icon: Settings,
                routeName: "settings",
                href: "/settings",
                isOpen: true,
                children: [
                    {
                        label: "User",
                        icon: User,
                        href: "/settings/user",
                    },
                    {
                        label: "General",
                        icon: Sliders,
                        href: "/settings/general",
                    },
                    {
                        label: "Backups",
                        icon: Database,
                        href: "/settings/backups",
                    },
                ],
            },
        ]
    },
    {
        title: "Inventory Management",
        items: [
            {
                label: "My Files",
                icon: FileText,
                routeName: "my-files",
                href: "/my-files",
                children: [
                    {
                        label: "Resume.pdf",
                        icon: FileText,
                        href: "/my-files/resume",
                    },
                    {
                        label: "Images",
                        icon: Image,
                        children: [
                            {
                                label: "Vacation.png",
                                icon: Image,
                                href: "/my-files/images/vacation",
                            },
                            {
                                label: "Work.png",
                                icon: Image,
                                href: "/my-files/images/work",
                            },
                        ],
                    },
                ],
            },
        ]
    }
];

const handleLogout = () => {
    Swal.fire({
        title: "Are you sure?",
        text: "You will be logged out of your account.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, logout!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.post("/logout");
        }
    });
};
</script>

<template>
    <div class="drawer-side z-40 is-drawer-close:overflow-visible">
        <label for="my-drawer-4" class="drawer-overlay"></label>
        <div class="flex h-full max-h-screen flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64 is-drawer-open:overflow-hidden is-drawer-close:overflow-visible">
            
            <div class="flex-none w-full flex items-center gap-2 px-4 py-4">
                <div class="avatar">
                    <div class="flex size-8 items-center justify-center rounded-full bg-primary text-primary-content">
                        <span class="text-sm font-bold">G</span>
                    </div>
                </div>
                <span class="text-base font-semibold is-drawer-close:hidden">Navbar Title</span>
            </div>

            <div class="flex-1 w-full is-drawer-open:overflow-y-auto is-drawer-close:overflow-visible min-h-0">
                <ul class="menu bg-base-200 text-sm w-full">
                    
                    <template v-for="(section, index) in menuSections" :key="index">
                        
                        <li 
                            v-if="section.title" 
                            class="is-drawer-close:hidden px-4 mt-4 mb-2 text-xs font-small text-base-content/50 uppercase tracking-wide"
                        >
                            {{ section.title }}
                        </li>

                        <SidebarItem
                            v-for="item in section.items"
                            :key="item.label"
                            :item="item"
                        />

                        <li v-if="index < menuSections.length - 1" class="mt-2 mb-2 border-b border-base-content/10"></li>
                    
                    </template>
                
                </ul>
            </div>

            <div class="flex-none w-full p-2 border-t border-base-300">
                <button
                    @click="handleLogout"
                    class="btn btn-ghost btn-sm w-full justify-start gap-2 px-4 text-error hover:bg-error/10"
                >
                    <LogOut class="size-4 shrink-0" />
                    <span class="is-drawer-close:hidden">Logout</span>
                </button>
            </div>
        </div>
    </div>
</template>