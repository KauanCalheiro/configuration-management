<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\ResponseService;
use App\Services\TaskService;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $tasks = QueryBuilder::for(Task::class)
                ->allowedFilters([
                    AllowedFilter::exact('id'),
                    'description',
                    'status',
                    'due_date',
                    'completed_at',
                    'created_at',
                    AllowedFilter::scope('search', 'whereScout')
                ])
                ->allowedSorts([
                    'id',
                    'status',
                    'description',
                    'due_date',
                    'completed_at',
                    'created_at',
                ])
                ->jsonPaginate();

            return ResponseService::success(data: $tasks, count: $tasks->toArray()['total']);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request) {
        try {
            $task = TaskService::make()->save($request);
            return ResponseService::success(data: $task);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task) {
        try {
            return ResponseService::success(data: $task);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task) {
        try {
            $task = TaskService::make($task)->save($request);
            return ResponseService::success(data: $task);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) {
        try {
            $task->delete();
            return ResponseService::success(message: 'Task deleted successfully');
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Generate a PDF for the specified task.
     */
    public function pdf(Task $task) {
        try {
            $pdf = Pdf::loadView('pdf_task', ['task' => $task]);
            return $pdf->stream('task.pdf');
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }
}
