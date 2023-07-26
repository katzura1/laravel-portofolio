<?php

use App\Http\Controllers\Admin\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/detail', function () {
    return view('project-detail');
});

Route::get('/projects', function () {
    return view('project-list');
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', [AuthController::class, 'index'])->name('admin.auth.index');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    Route::get('captcha', [AuthController::class, 'generateCaptcha'])->name('admin.auth.captcha');

    Route::post('login', [AuthController::class, 'login'])->name('admin.auth.login');

    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('admin.dashboard');
    });
});
