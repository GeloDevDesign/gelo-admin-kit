<script setup lang="ts">
import {ref,onMounted} from "vue";
import { Project } from './project.types';
import { useProject } from './project.composable';

// 1. Accept Data from Parent (Page)
const props = defineProps<{
    projects: Project[]
}>();

const { form, addProject, toggleStatus, removeProject, isSubmitting } = useProject();

console.log(props.projects);
</script>

<template>
    <div class="p-6 bg-white rounded shadow-md">
        <h2 class="text-xl font-bold mb-4">Project Manager</h2>

        <div class="flex gap-2 mb-6">
            <input 
                v-model="form.name" 
                @keyup.enter="addProject"
                type="text" 
                placeholder="New project name..." 
                class="border p-2 rounded w-full"
            />
            <button 
                @click="addProject" 
                :disabled="isSubmitting"
                class="bg-blue-600 text-white px-4 py-2 rounded disabled:opacity-50"
            >
                Add
            </button>
        </div>

        <ul class="space-y-3">
            <li 
                v-for="project in props.projects" 
                :key="project.id" 
                class="flex justify-between items-center p-3 border rounded hover:bg-gray-50"
            >
                <div>
                    <span class="font-medium">{{ project.name }}</span>
                    <span 
                        class="ml-2 text-xs px-2 py-1 rounded-full"
                        :class="project.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200'"
                    >
                        {{ project.status }}
                    </span>
                </div>

                <div class="flex gap-2">
                    <button 
                        @click="toggleStatus(project)" 
                        class="text-sm text-blue-600 hover:underline"
                    >
                        {{ project.status === 'active' ? 'Archive' : 'Activate' }}
                    </button>
                    
                    <button 
                        @click="removeProject(project.id)" 
                        class="text-sm text-red-600 hover:underline"
                    >
                        Delete
                    </button>
                </div>
            </li>
        </ul>
    </div>
</template>