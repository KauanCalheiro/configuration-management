export default interface Task {
    id: number;
    description: string;
    due_date?: string | null;
    status: string;
    completed_at?: string | null;
    created_at: string;
    updated_at: string;
    deleted_at?: string | null;
}