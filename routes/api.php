<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticalController;
use App\Http\Controllers\TheoryController;
use App\Http\Controllers\QuestionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(PracticalController::class)->prefix('practical')->group(function(){
    Route::get('list/{id}','list')->name('list');
    Route::post('create','create')->name('create');
    Route::post('update','update')->name('update');
    Route::post('delete/{id}','delete')->name('delete');
    Route::get('show/{id}','show')->name('show');
});

Route::controller(TheoryController::class)->prefix('theory')->group(function(){
    Route::get('list/{id}','list')->name('list');
    Route::post('create','create')->name('create');
    Route::post('update','update')->name('update');
    Route::post('delete/{id}','delete')->name('delete');
    Route::get('show/{id}','show')->name('show');
});

Route::controller(QuestionController::class)->prefix('question')->group(function(){
    Route::get('list/{id}','list')->name('list');
    Route::post('create','create')->name('create');
    Route::post('update','update')->name('update');
    Route::post('delete/{id}','delete')->name('delete');
    Route::get('show/{id}','show')->name('show');
});
