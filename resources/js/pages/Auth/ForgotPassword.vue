<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Mail, Send } from 'lucide-vue-next';

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
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <label class="input input-bordered flex items-center gap-2" :class="{ 'input-error': form.errors.email }">
                <Mail class="w-4 h-4 opacity-70" />
                <input type="email" class="grow" placeholder="email@example.com" v-model="form.email" required autofocus />
            </label>
            <div v-if="form.errors.email" class="label">
                <span class="label-text-alt text-error">{{ form.errors.email }}</span>
            </div>
        </div>

        <div class="form-control mt-6">
            <button class="btn btn-primary" :disabled="form.processing">
                <span v-if="form.processing" class="loading loading-spinner loading-xs"></span>
                <Send v-else class="w-4 h-4 mr-2" />
                Email Password Reset Link
            </button>
        </div>

        <div class="text-center mt-4">
            <Link :href="route('login')" class="link link-neutral text-sm">Back to Login</Link>
        </div>
    </form>
</template>
