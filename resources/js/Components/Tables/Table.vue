<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import Pagination from "./Pagination.vue";
import Actions from "@/Components/Buttons/Actions.vue";
import { MapPin } from "lucide-vue-next";

const props = defineProps<{
    columns?: string[];
}>();

const items = [
    {
        id: 1,
        name: "Cy Ganderton",
        email: "cy.ganderton@example.com",
        job: "Quality Control Specialist",
        department: "Quality Assurance",
        status: "Active",
        role: "Admin",
        last_login: "2 mins ago",
        location: "New York, USA",
        performance: 85,
    },
    {
        id: 2,
        name: "Hart Hagerty",
        email: "hart.hagerty@example.com",
        job: "Desktop Support Technician",
        department: "IT Support",
        status: "Offline",
        role: "User",
        last_login: "Yesterday",
        location: "London, UK",
        performance: 65,
    },
    {
        id: 3,
        name: "Brice Swyre",
        email: "brice.swyre@example.com",
        job: "Tax Accountant",
        department: "Finance",
        status: "Busy",
        role: "Editor",
        last_login: "3 days ago",
        location: "Paris, France",
        performance: 92,
    },
    {
        id: 4,
        name: "Marjy Ferencz",
        email: "marjy.ferencz@example.com",
        job: "Office Assistant",
        department: "Administration",
        status: "Active",
        role: "User",
        last_login: "1 week ago",
        location: "Berlin, Germany",
        performance: 78,
    },
    {
        id: 5,
        name: "Yancy Tear",
        email: "yancy.tear@example.com",
        job: "Community Outreach Specialist",
        department: "Marketing",
        status: "Active",
        role: "Moderator",
        last_login: "2 weeks ago",
        location: "Toronto, Canada",
        performance: 88,
    },
    {
        id: 6,
        name: "Irma Vasilik",
        email: "irma.vasilik@example.com",
        job: "Editor",
        department: "Content",
        status: "Inactive",
        role: "User",
        last_login: "1 month ago",
        location: "Warsaw, Poland",
        performance: 45,
    },
    {
        id: 7,
        name: "Meghann Durtnal",
        email: "meghann.durtnal@example.com",
        job: "Staff Accountant",
        department: "Finance",
        status: "Active",
        role: "User",
        last_login: "2 months ago",
        location: "Dublin, Ireland",
        performance: 95,
    },
];

const getStatusColor = (status: string) => {
    switch (status.toLowerCase()) {
        case "active":
            return "badge-soft badge-success";
        case "offline":
            return "badge-soft";
        case "busy":
            return "badge-soft badge-error";
        case "inactive":
            return "badge-soft badge-warning";
        default:
            return "badge-soft badge-info";
    }
};

const getPerformanceColor = (value: number) => {
    if (value >= 90) return "progress-success";
    if (value >= 70) return "progress-info";
    if (value >= 50) return "progress-warning";
    return "progress-error";
};
</script>

<template>
    <div
        class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100"
    >
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Performance</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.id">
                    <td>
                        <div>
                            <div class="font-bold">{{ item.name }}</div>
                            <div class="text-sm opacity-50">
                                {{ item.email }}
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ item.job }}
                        <br />
                        <span class="badge badge-soft badge-sm">{{
                            item.department
                        }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-1 text-sm opacity-70">
                            <MapPin class="size-3" />
                            {{ item.location }}
                        </div>
                    </td>
                    <td>
                        <div class="badge" :class="getStatusColor(item.status)">
                            {{ item.status }}
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <progress
                                class="progress w-16"
                                :class="getPerformanceColor(item.performance)"
                                :value="item.performance"
                                max="100"
                            ></progress>
                            <span class="text-xs opacity-70">{{ item.performance }}%</span>
                        </div>
                    </td>
                    <td>
                        <span class="text-sm text-base-content/70">{{ item.last_login }}</span>
                    </td>
                    <td>
                        <Actions />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        <Pagination
            :data="{
                current_page: 1,
                last_page: 5,
                links: [
                    { url: '?page=1', label: '1', active: true },
                    { url: '?page=2', label: '2', active: false },
                    { url: '?page=3', label: '3', active: false },
                    { url: '?page=4', label: '4', active: false },
                    { url: '?page=5', label: '5', active: false },
                ],
                total: 50,
            }"
        />
    </div>
</template>
