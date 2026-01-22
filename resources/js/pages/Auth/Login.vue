<script setup lang="ts">
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { LogIn, Mail, Lock } from 'lucide-vue-next';

defineOptions({ layout: AuthLayout });

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold">Welcome Back</h1>
        <p class="text-base-content/60">Sign in to your account</p>
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-success text-center">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
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

        <div class="form-control mt-4">
            <label class="label">
                <span class="label-text">Password</span>
            </label>
            <label class="input input-bordered flex items-center gap-2" :class="{ 'input-error': form.errors.password }">
                <Lock class="w-4 h-4 opacity-70" />
                <input type="password" class="grow" placeholder="••••••••" v-model="form.password" required />
            </label>
             <div v-if="form.errors.password" class="label">
                <span class="label-text-alt text-error">{{ form.errors.password }}</span>
            </div>
            <label class="label">
                <Link :href="route('password.request')" class="label-text-alt link link-hover">Forgot password?</Link>
            </label>
        </div>

        <div class="form-control mt-2">
            <label class="label cursor-pointer justify-start gap-2">
                <input type="checkbox" class="checkbox checkbox-sm" v-model="form.remember" />
                <span class="label-text">Remember me</span>
            </label>
        </div>

        <div class="form-control mt-6">
            <button class="btn btn-primary" :disabled="form.processing">
                <span v-if="form.processing" class="loading loading-spinner loading-xs"></span>
                <LogIn v-else class="w-4 h-4 mr-2" />
                Log in
            </button>
        </div>

        <div class="text-center mt-4">
            <span class="text-sm">Don't have an account? </span>
            <Link :href="route('register')" class="link link-primary text-sm">Sign up</Link>
        </div>
    </form>
</template>
