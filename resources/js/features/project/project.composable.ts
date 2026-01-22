import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { Project, ProjectForm } from './project.types';

export function useProject() {
    const form = ref<ProjectForm>({ name: '' });
    const isSubmitting = ref(false);

    // CREATE
    function addProject() {
        if (!form.value.name) return;
        
        isSubmitting.value = true;
        router.post('/projects', form.value, {
            onFinish: () => {
                isSubmitting.value = false;
                form.value.name = ''; // Reset input
            }
        });
    }

    // UPDATE (Toggle Status)
    function toggleStatus(project: Project) {

        const newStatus = project.status === 'active' ? 'archived' : 'active';
        
        router.put(`/projects/${project.id}`, { status: newStatus });
    }

    // DELETE
    function removeProject(id: number) {
        if (confirm('Are you sure?')) {
            router.delete(`/projects/${id}`);
        }
    }

    return { 
        form, 
        isSubmitting, 
        addProject, 
        toggleStatus, 
        removeProject 
    };
}