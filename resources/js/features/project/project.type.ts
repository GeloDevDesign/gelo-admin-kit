export interface Project {
    id: number;
    name: string;
    status: 'active' | 'archived';
    created_at: string;
    updated_at: string;
}

export type ProjectForm = {
    name: string;
} 