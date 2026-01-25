<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Key, Mail, Lock } from 'lucide-vue-next';
import InputFields from '@/Components/InputFields.vue';

defineOptions({ layout: GuestLayout });

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold">Reset Password</h1>
        <p class="text-base-content/60">Set a new password</p>
    </div>

    <form @submit.prevent="submit">
        <div class="form-control">
            <InputFields
                label="Email"
                type="email"
                v-model="form.email"
                :errors="form.errors.email"
                placeholder="email@example.com"
            >
                <template #icon>
                    <Mail class="w-4 h-4 opacity-70" />
                </template>
            </InputFields>
        </div>

        <div class="form-control mt-4">
            <InputFields
                label="Password"
                type="password"
                v-model="form.password"
                :errors="form.errors.password"
                placeholder="••••••••"
            >
                <template #icon>
                    <Lock class="w-4 h-4 opacity-70" />
                </template>
            </InputFields>
        </div>

        <div class="form-control mt-4">
            <InputFields
                label="Confirm Password"
                type="password"
                v-model="form.password_confirmation"
                :errors="form.errors.password_confirmation"
                placeholder="••••••••"
            >
                <template #icon>
                    <Lock class="w-4 h-4 opacity-70" />
                </template>
            </InputFields>
        </div>

        <div class="form-control mt-6">
            <button class="btn btn-primary" :disabled="form.processing">
                <span v-if="form.processing" class="loading loading-spinner loading-xs"></span>
                <Key v-else class="w-4 h-4 mr-2" />
                Reset Password
            </button>
        </div>
    </form>
</template>
