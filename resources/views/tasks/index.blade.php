<x-layouts.app :title="__('Tarefas')">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">
                Lista de Tarefas Final
            </h1>
            <a href="{{ route('tasks.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-zinc-800 rounded-md text-white dark:bg-zinc-700 hover:bg-zinc-500 dark:hover:bg-zinc-600 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Nova Tarefa
            </a>
        </div>

        <!-- Table Container -->
        <div class="bg-neutral-100 dark:bg-neutral-700 shadow-lg rounded-lg overflow-hidden">
            <div class="block ">
                @forelse ($tasks as $task)
                    <div class="border-b border-gray-200 dark:border-gray-700 last:border-b-0 p-4 space-y-3">
                        <div class="flex items-start justify-between">
                            <h3 class="font-medium text-gray-900 dark:text-white text-sm">
                                {{ $task->description }}
                            </h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($task->status === 'concluída')
                                            bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @elseif($task->status === 'pendente')
                                            bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                        @else
                                            bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                                        @endif">
                                {{ $task->status }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-500 dark:text-gray-400">
                            <div>
                                <span class="font-medium">Criada:</span>
                                {{ $task->created_at?->format('d/m/Y') }}
                            </div>
                            <div>
                                <span class="font-medium">Data de Vencimento:</span>
                                {{ $task->due_date?->format('d/m/Y') ?? 'N/A' }}
                            </div>
                            @if($task->completed_at)
                                <div class="col-span-2">
                                    <span class="font-medium">Concluída:</span>
                                    {{ $task->completed_at->format('d/m/Y') }}
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-wrap gap-2 pt-2">
                            <a href="{{ route('tasks.edit', $task->id) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Editar
                            </a>

                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Excluir
                                </button>
                            </form>

                            <a href="{{ route('tasks.pdf', $task->id) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-purple-500 hover:bg-purple-600 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                PDF
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-lg font-medium">Nenhuma tarefa encontrada</p>
                        <p class="text-sm mt-1">Clique em "Nova Tarefa" para começar</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
