<script setup lang="ts">
import { ref } from "vue";
import { Eye, EyeOff } from "lucide-vue-next";

// Define the interface for props to ensure type safety
interface InputProps {
    label?: string;
    type?: string;
    placeholder?: string;
    readonly?: boolean;
    errors?: string;
    selectionItems?: any[];
    form?: Record<string, any>;
    disabled?: boolean;
    isUpdate?: boolean;
    min?: string;
    max?: string;
}

// Set default values using withDefaults
const props = withDefaults(defineProps<InputProps>(), {
    type: "text",
    readonly: false,
    selectionItems: () => [],
    disabled: false,
    isUpdate: false,
});

// v-model for input value
// Using generic type <any> to support various input types (string, number, File, etc.)
const model = defineModel<any>({ required: true });

// Password visibility toggle
const showPassword = ref(false);

function handleFileChange(e: Event) {
    const target = e.target as HTMLInputElement;
    const file = target.files ? target.files[0] : null;
    model.value = file; // send the File object to parent form
}
</script>

<template>
    <div class="w-full">
        <!-- For text, email, search, number, tel, url inputs -->
        <fieldset
            v-if="
                ['text', 'email', 'search', 'number', 'tel', 'url'].includes(
                    props.type,
                )
            "
            class="fieldset w-full"
        >
            <legend
                v-if="props.label"
                class="fieldset-legend font-semibold text-start"
            >
                {{ props.label }}
            </legend>
            <label
                class="input input-bordered w-full flex items-center gap-2"
                :class="props.errors ? 'border-error' : ''"
            >
                <slot name="icon"></slot>
                <input
                    v-model="model"
                    :type="type"
                    :placeholder="placeholder"
                    :readonly="readonly"
                    :disabled="disabled"
                    :min="min"
                    :max="max"
                    class="grow"
                />
            </label>
            <p
                v-if="props.errors"
                class="text-error font-semibold bg-error/10 p-1 mt-1 rounded text-sm"
            >
                {{ props.errors }}
            </p>
        </fieldset>

        <!-- For textarea inputs -->
        <fieldset class="fieldset w-full" v-if="props.type === 'textarea'">
            <legend v-if="props.label" class="fieldset-legend font-semibold">
                {{ props.label }}
            </legend>
            <textarea
                v-model="model"
                class="textarea textarea-bordered h-24 w-full"
                :class="props.errors ? 'border-error' : ''"
                :placeholder="placeholder"
                :readonly="readonly"
                :disabled="disabled"
            ></textarea>
            <p
                v-if="props.errors"
                class="text-error font-semibold bg-error/10 p-1 mt-1 rounded text-sm"
            >
                {{ props.errors }}
            </p>
        </fieldset>

        <!-- For time inputs -->
        <fieldset class="fieldset w-full" v-if="props.type === 'time'">
            <legend v-if="props.label" class="fieldset-legend font-semibold">
                {{ props.label }}
            </legend>
            <label
                class="input input-bordered w-full flex items-center gap-2"
                :class="props.errors ? 'border-error' : ''"
            >
                <slot name="icon"></slot>
                <input
                    v-model="model"
                    type="time"
                    class="grow"
                    :placeholder="placeholder"
                    :readonly="readonly"
                    :disabled="disabled"
                    :min="min"
                    :max="max"
                />
            </label>
            <p
                v-if="props.errors"
                class="text-error font-semibold bg-error/10 p-1 mt-1 rounded text-sm"
            >
                {{ props.errors }}
            </p>
        </fieldset>

        <!-- For date inputs -->
        <fieldset v-if="props.type === 'date'" class="fieldset w-full">
            <legend v-if="props.label" class="fieldset-legend font-semibold">
                {{ props.label }}
            </legend>
            <label
                class="input input-bordered w-full flex items-center gap-2"
                :class="props.errors ? 'border-error' : ''"
            >
                <slot name="icon"></slot>

                <input
                    v-model="model"
                    type="date"
                    class="grow"
                    :placeholder="placeholder"
                    :min="min"
                    :max="max"
                    :readonly="readonly"
                    :disabled="disabled"
                />
            </label>
            <p
                v-if="props.errors"
                class="text-error font-semibold bg-error/10 p-1 mt-1 rounded text-sm"
            >
                {{ props.errors }}
            </p>
        </fieldset>

        <!-- For datetime-local inputs -->
        <fieldset
            v-if="props.type === 'datetime-local'"
            class="fieldset w-full"
        >
            <legend v-if="props.label" class="fieldset-legend font-semibold">
                {{ props.label }}
            </legend>
            <label
                class="input input-bordered w-full flex items-center gap-2"
                :class="props.errors ? 'border-error' : ''"
            >
                <slot name="icon"></slot>

                <input
                    v-model="model"
                    type="datetime-local"
                    class="grow"
                    :placeholder="placeholder"
                    :min="min"
                    :max="max"
                    :readonly="readonly"
                    :disabled="disabled"
                />
            </label>
            <p
                v-if="props.errors"
                class="text-error font-semibold bg-error/10 p-1 mt-1 rounded text-sm"
            >
                {{ props.errors }}
            </p>
        </fieldset>

        <!-- For password inputs with eye toggle -->
        <fieldset v-if="props.type === 'password'" class="fieldset w-full">
            <legend v-if="props.label" class="fieldset-legend font-semibold">
                {{ props.label }}
            </legend>
            <label
                class="input input-bordered w-full flex items-center gap-2 relative pr-10"
                :class="props.errors ? 'border-error' : ''"
            >
                <slot name="icon"></slot>
                <input
                    v-model="model"
                    :type="showPassword ? 'text' : 'password'"
                    :placeholder="placeholder"
                    :readonly="readonly"
                    :disabled="disabled"
                    autocomplete="current-password"
                    class="grow"
                />
                <button
                    type="button"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-primary transition-colors cursor-pointer z-10"
                    @click="showPassword = !showPassword"
                    tabindex="-1"
                >
                    <Eye v-if="!showPassword" class="size-4" />
                    <EyeOff v-else class="size-4" />
                </button>
            </label>
            <p
                v-if="props.errors"
                class="text-error font-semibold bg-error/10 p-1 mt-1 rounded text-sm"
            >
                {{ props.errors }}
            </p>
        </fieldset>

        <!-- For file inputs -->
        <fieldset v-if="props.type === 'file'" class="fieldset w-full">
            <legend v-if="props.label" class="fieldset-legend font-semibold">
                {{ props.label }}
            </legend>
            <input
                type="file"
                class="file-input file-input-bordered w-full"
                :class="props.errors ? 'file-input-error' : ''"
                @change="handleFileChange"
                :disabled="disabled"
            />
            <p
                v-if="props.errors"
                class="text-error font-semibold bg-error/10 p-1 mt-1 rounded text-sm"
            >
                {{ props.errors }}
            </p>
        </fieldset>
    </div>
</template>
