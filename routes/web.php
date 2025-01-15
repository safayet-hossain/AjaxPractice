<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;

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
Route::controller(PostController::class)->group(function(){

    Route::get('posts', 'index');

    Route::post('posts', 'store')->name('posts.store');

});

Route::controller(SearchController::class)->group(function(){

    Route::get('demo-search', 'index');

    Route::get('autocomplete', 'autocomplete')->name('autocomplete');

});
