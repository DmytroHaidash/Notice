<?php

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



Auth::routes();


/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Route::get('/unsubscribe/{user}', 'SubscribesController@destroy')->name('unsubscribe')->middleware('signed');
/** Front SPA routes */
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
