<script setup lang="ts">
import { Head, Link, router } from "@inertiajs/vue3";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Filter from "@/Components/Filter.vue";
import Actions from "@/Components/Buttons/Actions.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import { UserPlus } from "lucide-vue-next";
import { PaginationData, User } from "@/types";

const props = defineProps<{
    users?: PaginationData<User>;
    filters?: Object;
}>();

const handleEdit = (id: number) => {
    router.visit(route("settings.users.edit", id));
};

const handleDelete = (id: number) => {
    if (confirm("Are you sure you want to delete this user?")) {
        router.delete(route("settings.users.destroy", id));
    }
};

const userRoles = [
    { label: "Admin", value: "admin" },
    { label: "User", value: "user" },
];
</script>

<template>
    <Head title="Users" />

    <AuthLayout title="Users" description="Manage system users and their roles">
        <template #actions>
            <PrimaryButton
                label="Add New Users"
                :icon="UserPlus"
                :href="route('settings.users.create')"
            />
        </template>

        <template #filters>
            <Filter
                :has-search="true"
                :has-user-type="true"
                :data-user-role="userRoles"
                :filters="filters"
            />
        </template>

        <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users?.data" :key="user.id">
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar" v-if="user.avatar">
                                    <div class="mask mask-squircle w-12 h-12">
                                        <img
                                            :src="`/storage/${user.avatar}`"
                                            :alt="user.name"
                                        />
                                    </div>
                                </div>
                                <div class="avatar placeholder" v-else>
                                    <div
                                        class="bg-neutral text-neutral-content mask mask-squircle w-12 h-12"
                                    >
                                        <span class="text-xl">{{
                                            user.name.charAt(0)
                                        }}</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{ user.name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ user.email }}</td>
                        <td>
                            <div class="flex gap-1">
                                <span
                                    v-for="role in user.roles"
                                    :key="role.id"
                                    class="badge badge-ghost"
                                >
                                    {{ role.name }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <Actions
                                @edit="handleEdit(user.id)"
                                @delete="handleDelete(user.id)"
                            />
                        </td>
                    </tr>
                    <tr v-if="users?.data.length === 0">
                        <td colspan="4" class="text-center py-4">
                            No users found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Pagination :data="users" />
    </AuthLayout>
</template>
