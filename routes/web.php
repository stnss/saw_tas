<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SAWController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('content.dashboard');
    })->name('main');
    
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'kriterias', 'as' => 'kriterias.'], function () {
            Route::get('/', [KriteriaController::class, 'index'])->name('index');
            Route::get('/create', [KriteriaController::class, 'create'])->name('create');
            Route::post('/', [KriteriaController::class, 'store'])->name('store');
            Route::get('/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '/{kriteria}', [KriteriaController::class, 'update'])->name('update');
            Route::delete('/{kriteria}', [KriteriaController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'alternatifs', 'as' => 'alternatifs.'], function () {
            Route::get('/', [AlternatifController::class, 'index'])->name('index');
            Route::get('/create', [AlternatifController::class, 'create'])->name('create');
            Route::post('/', [AlternatifController::class, 'store'])->name('store');
            Route::get('/{alternatif}/edit', [AlternatifController::class, 'edit'])->name('edit');
            Route::match(['PUT', 'PATCH'], '/{alternatif}', [AlternatifController::class, 'update'])->name('update');
            Route::delete('/{alternatif}', [AlternatifController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'saw', 'as' => 'saw.'], function () {
            Route::get('/', [SAWController::class, 'index'])->name('index');
            Route::post('/', [SAWController::class, 'store'])->name('store');
            Route::post('/hasil/pdf', [SAWController::class, 'pdf'])->name('pdf');
        });
    });
});


