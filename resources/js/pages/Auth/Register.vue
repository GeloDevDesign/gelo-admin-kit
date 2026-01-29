<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { UserPlus, User, Mail, Lock } from 'lucide-vue-next';
import InputFields from '@/Components/InputFields.vue';
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";

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
            <InputFields
                label="Name"
                type="text"
                v-model="form.name"
                :errors="form.errors.name"
                placeholder="John Doe"
            >
                <template #icon>
                    <User class="w-4 h-4 opacity-70" />
                </template>
            </InputFields>
        </div>

        <div class="form-control mt-4">
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
            <PrimaryButton
                label="Sign Up"
                loadingLabel="Signing up..."
                :isLoading="form.processing"
                :icon="UserPlus"
                :isWide="true"
            />
        </div>

        <div class="text-center mt-4">
            <span class="text-sm">Already have an account? </span>
            <Link :href="route('login')" class="link link-primary text-sm">Log in</Link>
        </div>
    </form>
</template>
