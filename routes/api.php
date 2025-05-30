<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });

    Route::apiResource('user', UserController::class);

    Route::apiResource('task', TaskController::class);
    Route::get('task/{task}/pdf', [TaskController::class, 'pdf']);
});

Route::get('/teste', function () {
    $pdf = Pdf::loadView('pdf_task', ['task' => Task::first()]);

    return $pdf->download('task.pdf');
});