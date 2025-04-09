<?php
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {

Route::get('/categories', [CategoryController::class, 'index']);
});

?>