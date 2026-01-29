<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Mail, Send } from 'lucide-vue-next';
import InputFields from '@/Components/InputFields.vue';
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";

defineOptions({ layout: GuestLayout });

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold">Forgot Password</h1>
        <p class="text-base-content/60">Recover your account access</p>
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600 text-center">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div class="mb-4 text-sm text-base-content/80">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

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

        <div class="form-control mt-6">
            <PrimaryButton
                label="Email Password Reset Link"
                loadingLabel="Sending..."
                :isLoading="form.processing"
                :icon="Send"
                :isWide="true"
            />
        </div>

        <div class="text-center mt-4">
            <Link :href="route('login')" class="link link-neutral text-sm">Back to Login</Link>
        </div>
    </form>
</template>
