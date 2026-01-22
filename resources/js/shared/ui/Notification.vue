<script setup lang="ts">
import { Bell } from "lucide-vue-next";
</script>

<template>
    <label for="notification-drawer" class="btn btn-ghost btn-circle">
        <div class="indicator">
            <Bell class="size-5" />
            <span class="badge badge-xs badge-primary indicator-item"></span>
        </div>
    </label>
</template>