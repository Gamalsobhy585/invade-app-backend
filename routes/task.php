<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::middleware('auth:sanctum')->group(function () 
{


    Route::prefix('tasks')->group(function () 
    {
        Route::get('/', [TaskController::class, 'index']);
        Route::get('/deleted', [TaskController::class, 'getDeletedTasks']);
        Route::post('/', [TaskController::class, 'store']);
    
        Route::delete('/bulk-delete', [TaskController::class, 'bulkDelete']);
        Route::post('/bulk-restore', [TaskController::class, 'bulkRestore']);
        Route::delete('/bulk-force-delete', [TaskController::class, 'bulkForceDelete']);
    
        Route::post('/{id}/restore', [TaskController::class, 'restore']);
        Route::delete('/force/{task}', [TaskController::class, 'forceDelete']);
        
        Route::get('/{task}', [TaskController::class, 'show']);
        Route::patch('/{task}', [TaskController::class, 'update']);
        Route::delete('/{task}', [TaskController::class, 'destroy']);
    });
    

});



?>