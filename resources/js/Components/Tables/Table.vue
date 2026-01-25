<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import Pagination from "./Pagination.vue";
import Actions from "@/Components/Buttons/Actions.vue";

const props = defineProps<{
    columns: string[];
}>();

const items = [
    {
        id: 1,
        name: "Cy Ganderton",
        job: "Quality Control Specialist",
        color: "Blue",
    },
    {
        id: 2,
        name: "Hart Hagerty",
        job: "Desktop Support Technician",
        color: "Purple",
    },
    {
        id: 3,
        name: "Brice Swyre",
        job: "Tax Accountant",
        color: "Red",
    },

      {
        id: 3,
        name: "Brice Swyre",
        job: "Tax Accountant",
        color: "Red",
    },

      {
        id: 3,
        name: "Brice Swyre",
        job: "Tax Accountant",
        color: "Red",
    },


      {
        id: 3,
        name: "Brice Swyre",
        job: "Tax Accountant",
        color: "Red",
    },

     {
        id: 3,
        name: "Brice Swyre",
        job: "Tax Accountant",
        color: "Red",
    },

     {
        id: 3,
        name: "Brice Swyre",
        job: "Tax Accountant",
        color: "Red",
    },

      {
        id: 3,
        name: "Brice Swyre",
        job: "Tax Accountant",
        color: "Red",
    },
];
</script>

<template>
    <div
        class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100"
    >
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th v-for="(col, index) in columns" :key="index">
                        {{ col }}
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.id">
                    <th>{{ item.id }}</th>
                    <td>{{ item.name }}</td>
                    <td>{{ item.job }}</td>
                    <td>{{ item.color }}</td>
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
