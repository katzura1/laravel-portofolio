<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectImageController;
use App\Http\Controllers\Admin\ProjectStackController;
use App\Http\Controllers\HomeController;
use App\Models\ProjectStack;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/projects', [HomeController::class, 'projects'])->name('home.projects');
Route::get('/projects/{id}', [HomeController::class, 'projectDetail'])->name('home.project.detail');
Route::get('/projects.xml', [HomeController::class, 'projectSitemap'])->name('home.project_sitemap');

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', [AuthController::class, 'index'])->name('admin.auth.index');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    Route::get('captcha', [AuthController::class, 'generateCaptcha'])->name('admin.auth.captcha');

    Route::post('login', [AuthController::class, 'login'])->name('admin.auth.login');

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::group(['prefix' => 'project'], function () {
            Route::get('/', [ProjectController::class, 'index'])->name('admin.project.index');
            Route::post('store', [ProjectController::class, 'store'])->name('admin.project.store');
            Route::put('update', [ProjectController::class, 'update'])->name('admin.project.update');
            Route::delete('destroy', [ProjectController::class, 'destroy'])->name('admin.project.destroy');
        });

        Route::group(['prefix' => 'project_image'], function () {
            Route::get('/{id}', [ProjectImageController::class, 'index'])->name('admin.project_image.index');
            Route::post('store', [ProjectImageController::class, 'store'])->name('admin.project_image.store');
            Route::put('update', [ProjectImageController::class, 'update'])->name('admin.project_image.update');
            Route::delete('destroy', [ProjectImageController::class, 'destroy'])->name('admin.project_image.destroy');
        });

        Route::group(['prefix' => 'project_stack'], function () {
            Route::get('/{id}', [ProjectStackController::class, 'index'])->name('admin.project_stack.index');
            Route::post('store', [ProjectStackController::class, 'store'])->name('admin.project_stack.store');
            Route::put('update', [ProjectStackController::class, 'update'])->name('admin.project_stack.update');
            Route::delete('destroy', [ProjectStackController::class, 'destroy'])->name('admin.project_stack.destroy');
        });
    });
});
