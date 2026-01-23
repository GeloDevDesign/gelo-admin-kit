<script setup lang="ts">
import Filter from "@/Components/Filter.vue";
import Avatar from "@/Components/Avatar.vue";
import Notification from "@/Components/Notification.vue";
import Sidebar from "@/Components/Sidebar.vue";
import { PanelLeft, X } from "lucide-vue-next";
</script>

<template>
    <div class="drawer drawer-end">
        <input id="notification-drawer" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col h-screen overflow-hidden">
            <div class="drawer lg:drawer-open h-full">
                <input
                    id="my-drawer-4"
                    type="checkbox"
                    class="drawer-toggle"
                    checked="true"
                />

                <div class="drawer-content flex flex-col h-full overflow-hidden">
                    
                    <div class="flex-none flex justify-between items-center bg-base-300 w-full z-10">
                        <div>
                            <nav class="navbar">
                                <label
                                    for="my-drawer-4"
                                    class="btn btn-square btn-ghost"
                                >
                                    <PanelLeft class="my-1.5 inline-block size-4" />
                                </label>
                                <div class="px-4">Navbar Title</div>
                            </nav>
                        </div>
                        <div class="flex items-center gap-2 pr-2">
                            <Notification />
                            <Avatar />
                        </div>
                    </div>

                    <div class="p-4 overflow-y-auto flex-1 bg-base-100">
                        <div class="py-4"><Filter /></div>
                        <slot></slot>
                    </div>
                </div>

                <Sidebar />
            </div>
        </div>

        <div class="drawer-side z-50">
            <label for="notification-drawer" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 min-h-full w-80 p-4 text-base-content">
                <div class="flex justify-between items-center mb-4 pb-2 border-b border-base-300">
                    <span class="font-bold text-lg">Notifications</span>
                    <label for="notification-drawer" class="btn btn-sm btn-circle btn-ghost">
                        <X class="size-4" />
                    </label>
                </div>
                <li><a>New user signed up</a></li>
                <li><a>System update completed</a></li>
            </ul>
        </div>
    </div>
</template>