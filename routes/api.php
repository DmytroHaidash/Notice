<?php

use App\Http\Controllers\Api\AdvertisementsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'namespace' => 'Api',
    'middleware' => 'web',
], function () {
    Route::get('/users/{user}', 'UserController@profile');
    Route::put('/users/{user}', 'UserController@update');
    Route::get('/categories/all', 'CategoriesController@index');
    Route::get('/categories/parents', 'CategoriesController@parents');

    Route::group([
        'prefix' => 'favorite',
        'middleware' => 'auth',
    ], function () {
        Route::get('/items', 'FavoritesController@items');
        Route::get('/count', 'FavoritesController@count');
        Route::get('/{advertisement}', 'FavoritesController@check');
        Route::post('/{advertisement}', 'FavoritesController@store');
    });

    Route::group([
        'prefix' => 'comments',
    ], function () {
        Route::get('/', 'CommentsController@index');
        Route::post('/', 'CommentsController@store')->middleware('auth');
        Route::put('/{comment}', 'CommentsController@update')->middleware('auth');
    });

    Route::group([
        'prefix' => 'advertisements',
    ], function () {
        Route::get('/', 'AdvertisementsController@index');
        Route::post('/', 'AdvertisementsController@store')->middleware('auth');
        Route::get('/category/{category}', 'AdvertisementsController@categoryItems');
        Route::put('/{advertisement}', 'AdvertisementsController@update')->middleware('auth');
        Route::get('/{advertisement}', 'AdvertisementsController@show');
    });

    Route::post('/subscribe', 'SubscribesController@store')->middleware('auth');
});
