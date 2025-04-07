<?php
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\TaskController;


Route::middleware('auth:sanctum')->group(function () 
{


    Route::apiResource('tasks', TaskController::class);
    Route::get('tasks', [TaskController::class, 'index']);
    Route::post('tasks', [TaskController::class, 'store']);
    Route::get('tasks/{id}', [TaskController::class, 'show']);
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
    Route::post('tasks/{id}/restore', [TaskController::class, 'restore']);


});



?>