<script setup lang="ts">
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import { Save, Lock, Pencil } from "lucide-vue-next";

const page = usePage();
const user = computed(() => page.props.auth.user);

const profileForm = useForm({
    name: user.value.name,
    email: user.value.email,
});

const passwordForm = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const avatarForm = useForm({
    avatar: null as File | null,
});

const updateProfile = () => {
    profileForm.patch(route("profile.update"), {
        preserveScroll: true,
        onSuccess: () => {
            // Optional success handling
        },
    });
};

const updatePassword = () => {
    passwordForm.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => passwordForm.reset(),
    });
};

const updateAvatar = () => {
    if (avatarForm.avatar) {
        avatarForm.post(route("avatar.update"), {
            preserveScroll: true,
            onSuccess: () => avatarForm.reset(),
        });
    }
};

const avatarInput = ref<HTMLInputElement | null>(null);

const triggerAvatarUpload = () => {
    avatarInput.value?.click();
};

const handleAvatarChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        avatarForm.avatar = target.files[0];
        updateAvatar();
    }
};
</script>

<template>
    <AuthLayout title="Profile" description="Manage your profile settings.">
        <div class="tabs tabs-border">
            <input
                type="radio"
                name="profile_tabs"
                class="tab"
                aria-label="Profile Info"
                checked="checked"
            />
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Avatar Section -->
                    <div class="md:col-span-1 flex flex-col items-center gap-4">
                        <div class="relative">
                            <div class="avatar">
                                <div
                                    class="w-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2"
                                >
                                    <img
                                        :src="
                                            user.avatar
                                                ? `/storage/${user.avatar}`
                                                : `https://ui-avatars.com/api/?name=${user.name}`
                                        "
                                        :alt="user.name"
                                    />
                                </div>
                            </div>
                            <button
                                type="button"
                                @click="triggerAvatarUpload"
                                class="absolute bottom-0 right-0 btn btn-circle btn-sm btn-secondary shadow-lg"
                                :disabled="avatarForm.processing"
                                aria-label="Change Photo"
                            >
                                <span
                                    v-if="avatarForm.processing"
                                    class="loading loading-spinner loading-xs"
                                ></span>
                                <Pencil v-else class="w-4 h-4" />
                            </button>
                        </div>
                        <div class="text-center w-full">
                            <input
                                type="file"
                                ref="avatarInput"
                                class="hidden"
                                accept="image/*"
                                @change="handleAvatarChange"
                            />
                            <p class="text-xs text-base-content/50 mt-2">
                                JPG, GIF or PNG. Max 1MB.
                            </p>
                            <label
                                v-if="avatarForm.errors.avatar"
                                class="label text-error justify-center"
                            >
                                <span class="label-text-alt">{{
                                    avatarForm.errors.avatar
                                }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <div class="md:col-span-2">
                        <form @submit.prevent="updateProfile" class="space-y-6">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Name</span>
                                </label>
                                <input
                                    v-model="profileForm.name"
                                    type="text"
                                    class="input input-bordered w-full"
                                    required
                                />
                                <label
                                    v-if="profileForm.errors.name"
                                    class="label text-error"
                                >
                                    <span class="label-text-alt">{{
                                        profileForm.errors.name
                                    }}</span>
                                </label>
                            </div>

                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input
                                    v-model="profileForm.email"
                                    type="email"
                                    class="input input-bordered w-full"
                                    required
                                />
                                <label
                                    v-if="profileForm.errors.email"
                                    class="label text-error"
                                >
                                    <span class="label-text-alt">{{
                                        profileForm.errors.email
                                    }}</span>
                                </label>
                            </div>

                            <div class="card-actions justify-end">
                                <PrimaryButton
                                    type="submit"
                                    :is-loading="profileForm.processing"
                                    loading-label="Saving..."
                                    label="Save Changes"
                                    :icon="Save"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <input
                type="radio"
                name="profile_tabs"
                class="tab"
                aria-label="Security"
            />
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="">
                    <h2 class="text-lg font-medium mb-4">Update Password</h2>
                    <p class="text-sm text-base-content/70 mb-6">
                        Ensure your account is using a long, random password to
                        stay secure.
                    </p>

                    <form @submit.prevent="updatePassword" class="space-y-6">
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Current Password</span>
                            </label>
                            <input
                                v-model="passwordForm.current_password"
                                type="password"
                                class="input input-bordered w-full"
                                required
                            />
                            <label
                                v-if="passwordForm.errors.current_password"
                                class="label text-error"
                            >
                                <span class="label-text-alt">{{
                                    passwordForm.errors.current_password
                                }}</span>
                            </label>
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">New Password</span>
                            </label>
                            <input
                                v-model="passwordForm.password"
                                type="password"
                                class="input input-bordered w-full"
                                required
                            />
                            <label
                                v-if="passwordForm.errors.password"
                                class="label text-error"
                            >
                                <span class="label-text-alt">{{
                                    passwordForm.errors.password
                                }}</span>
                            </label>
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text">Confirm Password</span>
                            </label>
                            <input
                                v-model="passwordForm.password_confirmation"
                                type="password"
                                class="input input-bordered w-full"
                                required
                            />
                        </div>

                        <div class="card-actions justify-end">
                            <PrimaryButton
                                type="submit"
                                :is-loading="passwordForm.processing"
                                loading-label="Updating..."
                                label="Update Password"
                                :icon="Lock"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
