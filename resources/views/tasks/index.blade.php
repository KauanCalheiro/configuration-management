<x-layouts.app :title="__('Tarefas')">
    <style>
        .container {
            max-width: 1024px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            color: white;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: #2563eb;
            /* azul */
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-warning {
            background-color: #ca8a04;
            /* amarelo */
        }

        .btn-warning:hover {
            background-color: #a16207;
        }

        .btn-danger {
            background-color: #dc2626;
            /* vermelho */
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-purple {
            background-color: #7c3aed;
            /* roxo */
        }

        .btn-purple:hover {
            background-color: #5b21b6;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            border-collapse: collapse;
        }

        .table thead tr {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: 600;
            font-size: 0.875rem;
            text-align: left;
        }

        .table th,
        .table td {
            padding: 0.5rem 1rem;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .text-center {
            text-align: center;
            color: #6b7280;
            padding: 1rem 0;
        }
    </style>
    <div class="container">
        <div class="header">
            <h1 class="title">Lista de Tarefas</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                Nova Tarefa
            </a>
        </div>

        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Criada em</th>
                        <th>Vencimento</th>
                        <th>Concluída em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->created_at?->format('Y-m-d') }}</td>
                            <td>{{ $task->due_date?->format('Y-m-d') }}</td>
                            <td>{{ $task->completed_at?->format('Y-m-d') }}</td>
                            <td class="actions">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Editar</a>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>

                                <a href="{{ route('tasks.pdf', $task->id) }}" class="btn btn-purple">
                                    PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    @if($tasks->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma tarefa encontrada.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>