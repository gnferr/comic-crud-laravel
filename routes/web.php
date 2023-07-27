<?php

use App\Http\Controllers\admin\ComicController;
use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Route;


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

Route::redirect('/', 'admin/dashboard');
Route::prefix('admin')->group(function () {
    Route::redirect('/', 'admin/dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    Route::get('comic', [ComicController::class, 'index'])->name('admin.comic');
    Route::get('comic-list', [ComicController::class, 'get'])->name('admin.comic-list');
    Route::post('comic-edit', [ComicController::class, 'edit'])->name('admin.comic-edit');
    Route::post('comic-create', [ComicController::class, 'create'])->name('admin.comic-create');
    Route::post('comic-update', [ComicController::class, 'update'])->name('admin.comic-update');
    Route::post('comic-delete', [ComicController::class, 'delete'])->name('admin.comic-delete');
});
