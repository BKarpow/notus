<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\CategoryController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{id}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([ 
    'prefix' => '/notebook',
    'middleware' => 'auth'
], function () {
    Route::get('/', [NotebookController::class, 'index']);
    Route::post('/', [NotebookController::class, 'store']);
    Route::put('/', [NotebookController::class, 'update']);
    Route::delete('/', [NotebookController::class, 'destroy']);
});

Route::group([ 
    'prefix' => '/category',
    'middleware' => 'auth'
], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/', [CategoryController::class, 'update']);
    Route::delete('/', [CategoryController::class, 'destroy']);
});

