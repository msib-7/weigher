<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dataTables\Group;
use App\Http\Controllers\dataTables\Individual;
use App\Http\Controllers\dataTables\Summary;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'store'])->name('loginHris');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::prefix('v1')->name('v1.')->middleware(['auth', 'CheckJobLvlPermission'])->group(function () {
Route::prefix('v1')->name('v1.')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('table')->name('table.')->group(function () {
        Route::get('raw', [DashboardController::class, 'index'])->name('raw');
        Route::prefix('individual')->name('individual.')->group(function () {
            Route::get('', [Individual::class, 'index'])->name('index');
            Route::post('print', [Individual::class, 'print'])->name('print');
        });
        Route::get('group', [Group::class, 'index'])->name('group');
        Route::get('summary', [Summary::class, 'index'])->name('summary');
    });
});

Route::get('/data/json/individu', [Individual::class, 'getData'])->name('data.jsonIndividu');
Route::get('/data/json/kelompok', [Group::class, 'getData'])->name('data.jsonKelompok');
Route::get('/data/json/summary', [Summary::class, 'getData'])->name('data.jsonSummary');
Route::get('/data', [DashboardController::class, 'index'])->name('data.index');