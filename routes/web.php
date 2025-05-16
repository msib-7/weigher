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
Route::prefix('v1')->name('v1.')->middleware(['auth'])->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('table')->name('table.')->group(function () {
        Route::get('raw', [DashboardController::class, 'index'])->name('raw');
        Route::prefix('individual')->name('individual.')->group(function () {
            Route::get('', [Individual::class, 'index'])->name('index');
            Route::get('pdf', [Individual::class, 'exportPDF'])->name('export.pdf');
            Route::post('printDirect', [Individual::class, 'printD'])->name('printDirect');
        });
        Route::prefix('group')->name('group.')->group(function () {
            Route::get('', [Group::class, 'index'])->name('index');
            Route::post('print', [Group::class, 'print'])->name('print');
            Route::get('get', [Group::class, 'getData'])->name('getData');
        });
        // Route::get('group', [Group::class, 'index'])->name('group');
        Route::get('summary', [Summary::class, 'index'])->name('summary');
    });
});

Route::get('/data/json/individu', [Individual::class, 'getData'])->name('data.jsonIndividu');
Route::get('/data/json/kelompok', [Group::class, 'getData'])->name('data.jsonKelompok');
Route::get('/data/json/kelompok/{bn}', [Group::class, 'getData'])->name('data.jsonKelompokBn');
Route::get('/data/json/summary', [Summary::class, 'getData'])->name('data.jsonSummary');
Route::get('/data', [DashboardController::class, 'index'])->name('data.index');

Route::get('/getBn/I', [Individual::class, 'getBn']);
Route::get('/getBn/G', [Group::class, 'getBn']);
Route::get('/getBn/S', [Summary::class, 'getBn']);
Route::get('/getBn2', [DashboardController::class, 'getBn']);
Route::get('/getSummary/I/{bn}/{ipc}', [Individual::class, 'getSummary']);
Route::get('/getSummary/G/{bn}/{ipc}', [Group::class, 'getSummary']);
Route::get('/getIpc/G/{bn}', [Group::class, 'getIpc']);
Route::get('/getIpc/I/{bn}', [Individual::class, 'getIpc']);


Route::get('/chart/1/{bn}', [Individual::class, 'loadChart1']);