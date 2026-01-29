<script setup lang="ts">
import { usePage, router, Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { User, LogOut } from "lucide-vue-next";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);

const logout = (): void => {
    Swal.fire({
        title: "Log out?",
        text: "Are you sure you want to sign out?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, log out!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route("logout"));
        }
    });
};
</script>

<template>
    <div class="dropdown dropdown-end">
        <div
            tabindex="0"
            role="button"
            class="avatar btn btn-ghost btn-circle p-1"
        >
            <div class="w-10 rounded-full">
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

        <ul
            tabindex="0"
            class="menu dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow"
        >
            <li>
                <Link :href="route('profile.edit')">
                    <User class="size-4" /> Profile
                </Link>
            </li>
            <li>
                <a class="text-error" @click="logout()">
                    <LogOut class="size-4" /> Log out
                </a>
            </li>
        </ul>
    </div>
</template>
