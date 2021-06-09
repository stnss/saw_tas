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
        Route::resource('kriterias', KriteriaController::class);
        Route::resource('alternatifs', AlternatifController::class);
        Route::group(['prefix' => 'saw', 'as' => 'saw.'], function () {
            Route::get('/', [SAWController::class, 'index'])->name('index');
            Route::post('/', [SAWController::class, 'store'])->name('store');
        });
    });
});


