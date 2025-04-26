<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequestLogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Mail\MyTestEmail;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('log', [RequestLogController::class, 'index']);

    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });

    Route::apiResource('role', RoleController::class);
    Route::post('role/{role}/assign/permission', [RoleController::class, 'assignPermission']);
    Route::post('role/{role}/revoke/permission', [RoleController::class, 'revokePermission']);

    Route::apiResource('permission', PermissionController::class);

    Route::apiResource('user', UserController::class);
    Route::post('user/{user}/assign/role', [UserController::class, 'assignRole']);
    Route::post('user/{user}/revoke/role', [UserController::class, 'revokeRole']);
    Route::post('user/{user}/assign/permission', [UserController::class, 'assignPermission']);
    Route::post('user/{user}/revoke/permission', [UserController::class, 'revokePermission']);

    Route::apiResource('task', TaskController::class);
    Route::get('task/{task}/pdf', [TaskController::class, 'pdf']);
});

Route::get('/teste', function () {
    $pdf = Pdf::loadView('pdf_task', ['task' => Task::first()]);

    return $pdf->download('task.pdf');
});