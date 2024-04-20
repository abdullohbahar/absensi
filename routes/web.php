<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KelasAdminController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::prefix('kelas')->group(function () {
        Route::get('/', [KelasAdminController::class, 'index'])->name('admin.kelas');
        Route::get('/create', [KelasAdminController::class, 'create'])->name('admin.create.kelas');
        Route::post('/store', [KelasAdminController::class, 'store'])->name('admin.store.kelas');
        Route::delete('/destroy/{id}', [KelasAdminController::class, 'destroy'])->name('admin.destroy.kelas');
    });
});
