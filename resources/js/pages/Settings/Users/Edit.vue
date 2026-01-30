<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import InputFields from "@/Components/InputFields.vue";

const props = defineProps({
    user: Object,
    roles: Array,
});

const form = useForm({
    _method: "PUT",
    name: props.user.name,
    email: props.user.email,
    password: "",
    password_confirmation: "",
    avatar: null,
    roles: props.user.roles.map((r) => r.id),
});

const submit = () => {
    form.post(route("settings.users.update", props.user.id), {
        onSuccess: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Edit User" />

    <AuthLayout title="Edit User" description="Edit user details and roles">
        <template #actions>
            <Link :href="route('settings.users.index')" class="btn btn-ghost">
                Back to Users
            </Link>
        </template>

        <div class="bg-base-100 p-6 rounded-lg shadow max-w-4xl mx-auto">
            <form @submit.prevent="submit" class="space-y-4">
                <div class="flex items-center gap-4 mb-6" v-if="user.avatar">
                    <div class="avatar">
                        <div class="w-24 rounded-full">
                            <img :src="`/storage/${user.avatar}`" />
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold">Current Avatar</h3>
                        <p class="text-sm opacity-70">Upload a new one to replace it.</p>
                    </div>
                </div>

                <InputFields
                    label="Name"
                    v-model="form.name"
                    :errors="form.errors.name"
                    placeholder="John Doe"
                />

                <InputFields
                    label="Email"
                    type="email"
                    v-model="form.email"
                    :errors="form.errors.email"
                    placeholder="john@example.com"
                />

                <div class="divider">Change Password (Optional)</div>

                <InputFields
                    label="New Password"
                    type="password"
                    v-model="form.password"
                    :errors="form.errors.password"
                    placeholder="Leave empty to keep current"
                />

                <InputFields
                    label="Confirm New Password"
                    type="password"
                    v-model="form.password_confirmation"
                    :errors="form.errors.password_confirmation"
                    placeholder="Leave empty to keep current"
                />

                <div class="divider">Settings</div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Avatar</span>
                    </label>
                    <input
                        type="file"
                        class="file-input file-input-bordered w-full"
                        @input="form.avatar = $event.target.files[0]"
                        accept="image/*"
                    />
                    <div v-if="form.errors.avatar" class="text-error text-sm mt-1">
                        {{ form.errors.avatar }}
                    </div>
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Roles</span>
                    </label>
                    <div class="flex flex-wrap gap-4">
                        <label
                            v-for="role in roles"
                            :key="role.id"
                            class="label cursor-pointer gap-2 border rounded px-3 py-2"
                        >
                            <span class="label-text">{{ role.name }}</span>
                            <input
                                type="checkbox"
                                :value="role.id"
                                v-model="form.roles"
                                class="checkbox"
                            />
                        </label>
                    </div>
                    <div v-if="form.errors.roles" class="text-error text-sm mt-1">
                        {{ form.errors.roles }}
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <Link :href="route('settings.users.index')" class="btn btn-ghost">
                        Cancel
                    </Link>
                    <button type="submit" class="btn btn-primary" :disabled="form.processing">
                        {{ form.processing ? "Saving..." : "Save Changes" }}
                    </button>
                </div>
            </form>
        </div>
    </AuthLayout>
</template>
