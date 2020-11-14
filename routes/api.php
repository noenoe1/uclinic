<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\ServiceController;
use App\Http\Controllers\ApiControllers\BlogController;
use App\Http\Controllers\ApiControllers\AboutController;
use App\Http\Controllers\ApiControllers\DepartmentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Service API
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/services/get_all/limit/{limit}/offset/{offset}/login_user_id/{login_user_id}', [ServiceController::class, 'getAll'])->name('api.services.get_all');
    Route::get('/services/get_service_by_id/id/{id}', [ServiceController::class, 'get_service_by_id'])->name('api.services.get_service_by_id');
});

// Blog API
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/blogs/get_all/limit/{limit}/offset/{offset}/login_user_id/{login_user_id}', [BlogController::class, 'getAll'])->name('api.blogs.get_all');
    Route::get('/blogs/get_blog_by_id/id/{id}', [BlogController::class, 'get_blog_by_id'])->name('api.services.get_blog_by_id');
});

// About API
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/abouts/get_about_by_id/id/{id}', [AboutController::class, 'get_about_by_id'])->name('api.abouts.get_about_by_id');
});

// Department API
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/departments/get_all/limit/{limit}/offset/{offset}/login_user_id/{login_user_id}', [DepartmentController::class, 'getAll'])->name('api.departments.get_all');
    Route::get('/departments/get_department_by_id/id/{id}', [DepartmentController::class, 'get_department_by_id'])->name('api.departments.get_department_by_id');
});