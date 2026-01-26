<script setup lang="ts">
import { ref } from "vue";
import { Search, Calendar } from "lucide-vue-next";
import { router } from "@inertiajs/vue3";

interface Props {
    hasSearch?: boolean;
    hasUserType?: boolean;
    dataUserRole?: Array<{ label: string; value: string | number }>;
    // New Filters
    hasStatus?: boolean;
    dataStatus?: Array<{ label: string; value: string | number }>;
    hasDate?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    hasSearch: false,
    hasUserType: false,
    dataUserRole: () => [],
    // Defaults for new filters
    hasStatus: false,
    dataStatus: () => [
        // Static data for now as requested
        { label: "Active", value: "active" },
        { label: "Inactive", value: "inactive" },
        { label: "Pending", value: "pending" },
    ],
    hasDate: false,
});

const filters = ref({
    s: "",
    user_type: "",
    status: "",
    date: "",
});

const handleApply = () => {
    // Create a base object
    const query: Record<string, any> = {};

    // Use Object.assign to merge current non-empty filters
    if (filters.value.s) {
        Object.assign(query, { s: filters.value.s });
    }
    
    if (filters.value.user_type) {
        Object.assign(query, { user_type: filters.value.user_type });
    }

    if (filters.value.status) {
        Object.assign(query, { status: filters.value.status });
    }

    if (filters.value.date) {
        Object.assign(query, { date: filters.value.date });
    }

    // Console logger as requested
    console.log("Data Selected:", query);

    /* 
    // Commented out router request as requested
    router.get(route(route.current() as string), query, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    }); 
    */
};

const handleReset = () => {
    filters.value.s = "";
    filters.value.user_type = "";
    filters.value.status = "";
    filters.value.date = "";
    
    console.log("Filters Reset");

    /*
    // Clear query params by visiting without them
    router.get(route(route.current() as string), {}, {
        preserveState: true,
        preserveScroll: true,
    });
    */
};
</script>

<template>
    <div class="flex flex-col lg:flex-row gap-4 items-end bg-base-100 p-4 rounded-lg border border-base-200">
        <!-- Search -->
        <div v-if="hasSearch" class="form-control w-full sm:max-w-[300px]">
            <div class="label">
                <span class="label-text">Search</span>
            </div>
            <label class="input input-bordered flex items-center gap-2">
                <Search class="w-4 h-4 opacity-70" />
                <input
                    v-model="filters.s"
                    type="text"
                    class="grow"
                    placeholder="Search..."
                    @keyup.enter="handleApply"
                />
            </label>
        </div>

        <!-- User Type -->
        <div v-if="hasUserType" class="form-control w-full sm:max-w-[200px]">
            <div class="label">
                <span class="label-text">User Role</span>
            </div>
            <select v-model="filters.user_type" class="select select-bordered w-full">
                <option value="">All Roles</option>
                <option
                    v-for="role in dataUserRole"
                    :key="role.value"
                    :value="role.value"
                >
                    {{ role.label }}
                </option>
            </select>
        </div>

        <!-- Status Filter (New) -->
        <div v-if="hasStatus" class="form-control w-full sm:max-w-[200px]">
            <div class="label">
                <span class="label-text">Status</span>
            </div>
            <select v-model="filters.status" class="select select-bordered w-full">
                <option value="">All Status</option>
                <option
                    v-for="status in dataStatus"
                    :key="status.value"
                    :value="status.value"
                >
                    {{ status.label }}
                </option>
            </select>
        </div>

        <!-- Date Filter (New) -->
        <div v-if="hasDate" class="form-control w-full sm:max-w-[200px]">
            <div class="label">
                <span class="label-text">Date</span>
            </div>
            <label class="input input-bordered flex items-center gap-2">
                <Calendar class="w-4 h-4 opacity-70" />
                <input
                    v-model="filters.date"
                    type="date"
                    class="grow"
                />
            </label>
        </div>

        <!-- Buttons -->
        <div class="flex gap-2 mt-4 lg:mt-0 ml-auto lg:ml-0">
            <button @click="handleReset" class="btn btn-error btn-soft">
                Reset
            </button>
            <button @click="handleApply" class="btn btn-primary">
                Search
            </button>
        </div>
    </div>
</template>
