<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\BeControllers\ServiceController;
use App\Http\Controllers\BeControllers\BlogController;
use App\Http\Controllers\BeControllers\AboutController;
use App\Http\Controllers\BeControllers\DepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::post('/image/upload', [ImageUploadController::class, 'upload'])->name('image.upload');
Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

/**
 * Service Routing
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/list', [ServiceController::class, 'index'])->name('services.list');
    Route::get('/services/view/{service}', [ServiceController::class, 'view'])->name('services.view');
    Route::post('/services/update/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::get('/services/delete/{service}', [ServiceController::class, 'delete'])->name('services.delete');
    Route::get('/services/getall', [ServiceController::class, 'getAll'])->name('services.getall');
    Route::get('/services/getallservices', [ServiceController::class, 'getAllservices'])->name('services.getallservices');
    Route::delete('/services/destroy/{service_id}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

/**
 * Blog Routing
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/list', [BlogController::class, 'index'])->name('blogs.list');
    Route::get('/blogs/view/{blog}', [BlogController::class, 'view'])->name('blogs.view');
    Route::post('/blogs/update/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::get('/blogs/delete/{blog}', [BlogController::class, 'delete'])->name('blogs.delete');
    Route::get('/blogs/getall', [BlogController::class, 'getAll'])->name('blogs.getall');
    Route::delete('/blogs/destroy/{blog_id}', [BlogController::class, 'destroy'])->name('blogs.destroy');

});

/**
 * About Routing
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/abouts/view', [AboutController::class, 'view'])->name('abouts.view');
    Route::post('/abouts/update/{about}', [AboutController::class, 'update'])->name('abouts.update');
});

/**
 * Department Routing
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/list', [DepartmentController::class, 'index'])->name('departments.list');
    Route::get('/departments/view/{department}', [DepartmentController::class, 'view'])->name('departments.view');
    Route::post('/departments/update/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::get('/departments/delete/{department}', [DepartmentController::class, 'delete'])->name('departments.delete');
    Route::get('/departments/getall', [DepartmentController::class, 'getAll'])->name('departments.getall');

});
