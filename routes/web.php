<?php

use App\Http\Controllers\admin\ComicController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserAccount;
use App\Http\Controllers\auth\LoginController;
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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('testing', [UserAccount::class, 'testing'])->name('testing');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::redirect('/', 'admin/dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Comic 
    Route::controller(ComicController::class)->group(function () {
        Route::get('comic', 'index')->name('comic');
        Route::get('comic-list', 'get')->name('comic-list');
        Route::post('comic-edit', 'edit')->name('comic-edit');
        Route::post('comic-create', 'create')->name('comic-create');
        Route::post('comic-delete', 'delete')->name('comic-delete');
    });

    // Users
    Route::controller(UserAccount::class)->group(function () {
        Route::get('users', 'index')->name('users');
        Route::get('users-list', 'get')->name('user-list');
        Route::post('users-create', 'create')->name('user-create');
        Route::post('users-update', 'update')->name('user-update');
        Route::get('users/account-setting/{id}', 'account')->name('user-setting');
    });
});

// Route::prefix('admin')->group(function () {
// });
