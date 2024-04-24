<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KelasAdminController;
use App\Http\Controllers\Admin\SiswaAdminController;
use App\Http\Controllers\Guru\ExportController;
use App\Http\Controllers\Guru\GuruController;
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

Route::get('/', [GuruController::class, 'index'])->name('guru.index');
Route::get('presensi/{kelas}', [GuruController::class, 'presensi'])->name('guru.presensi');
Route::post('absensi/{idSiswa}/{keterangan}', [GuruController::class, 'absensi'])->name('guru.absensi.siswa');
Route::put('update-absensi', [GuruController::class, 'updateAbsensi'])->name('guru.update.absensi.siswa');

Route::get('export', [ExportController::class, 'index'])->name('guru.index.export');
Route::post('action-export', [ExportController::class, 'export'])->name('guru.action.export');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::prefix('kelas')->group(function () {
        Route::get('/', [KelasAdminController::class, 'index'])->name('admin.kelas');
        Route::get('/create', [KelasAdminController::class, 'create'])->name('admin.create.kelas');
        Route::post('/store', [KelasAdminController::class, 'store'])->name('admin.store.kelas');
        Route::delete('/destroy/{id}', [KelasAdminController::class, 'destroy'])->name('admin.destroy.kelas');
    });

    Route::prefix('siswa')->group(function () {
        Route::get('/', [SiswaAdminController::class, 'index'])->name('admin.siswa');
        Route::get('/create', [SiswaAdminController::class, 'create'])->name('admin.create.siswa');
        Route::post('/store', [SiswaAdminController::class, 'store'])->name('admin.store.siswa');
        Route::get('/edit/{id}', [SiswaAdminController::class, 'edit'])->name('admin.edit.siswa');
        Route::put('/update/{id}', [SiswaAdminController::class, 'update'])->name('admin.update.siswa');
        Route::delete('/destroy/{id}', [SiswaAdminController::class, 'destroy'])->name('admin.destroy.siswa');
        Route::post('import', [SiswaAdminController::class, 'import'])->name('admin.import.siswa');
    });
});
