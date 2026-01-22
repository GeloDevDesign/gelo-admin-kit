<script setup lang="ts">
import AuthLayout from "@/layouts/AuthLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Mail, LogOut } from "lucide-vue-next";

defineOptions({ layout: AuthLayout });

const props = defineProps<{
    status?: string;
}>();

const form = useForm({});

const submit = () => {
    form.post(route("verification.send"));
};

const logout = () => {
    form.post(route("logout"));
};
</script>

<template>
    <Head title="Email Verification" />

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold">Verify Your Email</h1>
        <p class="text-base-content/60">Thanks for signing up!</p>
    </div>

    <div class="mb-4 text-sm text-base-content/80">
        Before getting started, could you verify your email address by clicking
        on the link we just emailed to you? If you didn't receive the email, we
        will gladly send you another.
    </div>

    <div
        v-if="status === 'verification-link-sent'"
        class="mb-4 font-medium text-sm text-green-600"
    >
        A new verification link has been sent to the email address you provided
        during registration.
    </div>

    <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
            <button class="btn btn-primary" :disabled="form.processing">
                <span
                    v-if="form.processing"
                    class="loading loading-spinner loading-xs"
                ></span>
                <Mail v-else class="w-4 h-4 mr-2" />
                Resend Verification Email
            </button>

            <button @click.prevent="logout" class="btn btn-ghost">
                <LogOut class="w-4 h-4 mr-2" />
                Log Out
            </button>
        </div>
    </form>
</template>
