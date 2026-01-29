<script setup lang="ts">
import { Pencil, Trash2 } from "lucide-vue-next";

interface ButtonConfig {
    hasEdit?: boolean;
    hasDelete?: boolean;
}

const props = withDefaults(
    defineProps<{
        buttonConfig?: ButtonConfig;
    }>(),
    {
        buttonConfig: () => ({
            hasEdit: true,
            hasDelete: true,
        }),
    },
);

defineEmits<{
    edit: [];
    delete: [];
}>();
</script>

<template>
    <div class="flex items-center gap-1">
        <button
            v-if="props.buttonConfig?.hasEdit"
            class="btn btn-sm btn-square btn-ghost text-warning tooltip"
            data-tip="Edit"
            @click="$emit('edit')"
        >
            <Pencil class="size-4" />
        </button>
        <button
            v-if="props.buttonConfig?.hasDelete"
            class="btn btn-sm btn-square btn-ghost text-error tooltip"
            data-tip="Delete"
            @click="$emit('delete')"
        >
            <Trash2 class="size-4" />
        </button>
    </div>
</template>
