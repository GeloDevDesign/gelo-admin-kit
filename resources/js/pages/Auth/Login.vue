<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { LogIn, Mail, Lock } from 'lucide-vue-next';
import InputFields from '@/Components/InputFields.vue';

defineOptions({ layout: GuestLayout });

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
