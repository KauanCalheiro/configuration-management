<x-layouts.app :title="__('Editar Tarefa')">
    <div style="max-width: 600px; margin: 2rem auto; padding: 1rem;">
        <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 1.5rem;">Editar Tarefa</h1>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST"
            style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            @method('PUT')

            <div>
                <label for="description"
                    style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Descrição</label>
                <input type="text" name="description" id="description"
                    value="{{ old('description', $task->description) }}" required
                    style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem;">
                @error('description')
                    <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="due_date" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Data de
                    Vencimento</label>
                <input type="date" name="due_date" id="due_date"
                    value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                    style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem;">
                @error('due_date')
                    <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Status</label>
                <select name="status" id="status" required
                    style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem;">
                    <option value="Parado" {{ old('status', $task->status) == 'Parado' ? 'selected' : '' }}>Parado
                    </option>
                    <option value="Em andamento" {{ old('status', $task->status) == 'Em andamento' ? 'selected' : '' }}>Em
                        andamento</option>
                    <option value="Concluido" {{ old('status', $task->status) == 'Concluido' ? 'selected' : '' }}>
                        Concluído</option>
                </select>
                @error('status')
                    <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" style="
                    background-color: #2563eb;
                    color: white;
                    border: none;
                    padding: 0.5rem 1.25rem;
                    border-radius: 4px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: background-color 0.2s;
                " onmouseover="this.style.backgroundColor='#1d4ed8'" onmouseout="this.style.backgroundColor='#2563eb'">
                    Atualizar
                </button>

                <a href="{{ route('tasks.index') }}" style="
                    background-color: #dc2626;
                    color: white;
                    padding: 0.5rem 1.25rem;
                    border-radius: 4px;
                    font-weight: 600;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: background-color 0.2s;
                " onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>