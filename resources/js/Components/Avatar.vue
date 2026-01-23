<script setup lang="ts">
import { ref, onMounted } from "vue";
import Swal from "sweetalert2";
import { User, LogOut } from "lucide-vue-next";

const logout = (): void => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success",
                showConfirmButton: false,
            });
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
            <div class="w-32 rounded-full">
                <img
                    src="https://img.daisyui.com/images/profile/demo/yellingcat@192.webp"
                    alt="Avatar"
                />
            </div>
        </div>

        <ul
            tabindex="0"
            class="menu dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow"
        >
            <li>
                <a> <User class="size-4" /> Profile </a>
            </li>
            <li>
                <a class="text-error" @click="logout()">
                    <LogOut class="size-4" /> Log out
                </a>
            </li>
        </ul>
    </div>
</template>
