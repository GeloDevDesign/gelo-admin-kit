<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import InputFields from "@/Components/InputFields.vue";

const props = defineProps({
    roles: Array,
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    avatar: null,
    roles: [],
});

const submit = () => {
    form.post(route("settings.users.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Create User" />

    <AuthLayout title="Create User" description="Add a new user to the system">
        <template #actions>
            <Link :href="route('settings.users.index')" class="btn btn-ghost">
                Back to Users
            </Link>
        </template>

        <div class="bg-base-100 p-6 rounded-lg shadow max-w-4xl mx-auto">
            <form @submit.prevent="submit" class="space-y-4">
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

                <InputFields
                    label="Password"
                    type="password"
                    v-model="form.password"
                    :errors="form.errors.password"
                    placeholder="********"
                />

                <InputFields
                    label="Confirm Password"
                    type="password"
                    v-model="form.password_confirmation"
                    :errors="form.errors.password_confirmation"
                    placeholder="********"
                />

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
                        {{ form.processing ? "Creating..." : "Create User" }}
                    </button>
                </div>
            </form>
        </div>
    </AuthLayout>
</template>
