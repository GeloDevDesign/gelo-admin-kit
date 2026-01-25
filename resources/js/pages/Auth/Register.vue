<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { UserPlus, User, Mail, Lock } from 'lucide-vue-next';

defineOptions({ layout: GuestLayout });

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold">Create Account</h1>
        <p class="text-base-content/60">Join us today</p>
    </div>

    <form @submit.prevent="submit">
        <div class="form-control">
            <label class="label">
                <span class="label-text">Name</span>
            </label>
            <label class="input input-bordered flex items-center gap-2" :class="{ 'input-error': form.errors.name }">
                <User class="w-4 h-4 opacity-70" />
                <input type="text" class="grow" placeholder="John Doe" v-model="form.name" required autofocus />
            </label>
            <div v-if="form.errors.name" class="label">
                <span class="label-text-alt text-error">{{ form.errors.name }}</span>
            </div>
        </div>

        <div class="form-control mt-4">
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <label class="input input-bordered flex items-center gap-2" :class="{ 'input-error': form.errors.email }">
                <Mail class="w-4 h-4 opacity-70" />
                <input type="email" class="grow" placeholder="email@example.com" v-model="form.email" required />
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
        </div>

        <div class="form-control mt-4">
            <label class="label">
                <span class="label-text">Confirm Password</span>
            </label>
            <label class="input input-bordered flex items-center gap-2" :class="{ 'input-error': form.errors.password_confirmation }">
                <Lock class="w-4 h-4 opacity-70" />
                <input type="password" class="grow" placeholder="••••••••" v-model="form.password_confirmation" required />
            </label>
            <div v-if="form.errors.password_confirmation" class="label">
                <span class="label-text-alt text-error">{{ form.errors.password_confirmation }}</span>
            </div>
        </div>

        <div class="form-control mt-6">
            <button class="btn btn-primary" :disabled="form.processing">
                <span v-if="form.processing" class="loading loading-spinner loading-xs"></span>
                <UserPlus v-else class="w-4 h-4 mr-2" />
                Sign Up
            </button>
        </div>

        <div class="text-center mt-4">
            <span class="text-sm">Already have an account? </span>
            <Link :href="route('login')" class="link link-primary text-sm">Log in</Link>
        </div>
    </form>
</template>
