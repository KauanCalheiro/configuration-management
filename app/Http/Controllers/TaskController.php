<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\ResponseService;
use App\Services\TaskService;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class TaskController extends Controller {
    public function index() {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request) {
        TaskService::make()->save($request);
        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function edit(Task $task) {
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task) {
        $task = TaskService::make($task)->save($request);
        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }

    public function pdf(Task $task) {
        try {
            $pdf = Pdf::loadView('pdf_task', ['task' => $task]);
            return $pdf->stream('task.pdf');
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }
}
