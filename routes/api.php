<?php

use App\Http\Controllers\Api\AdvertisementsController;
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
    Route::get('/profile/{user}', [UserController::class, 'profile']);
    Route::post('/profile/{user}',[UserController::class, 'update']);
    Route::group([
        'prefix' => 'advertisements',
    ], function () {
       Route::get('/', [AdvertisementsController::class, 'items']);
       Route::post('/store', [AdvertisementsController::class, 'store'])->middleware('auth');
       Route::post('/update/{advertisement}', [AdvertisementsController::class, 'update'])->middleware('auth');
       Route::get('/{advertisement}', [AdvertisementsController::class, 'item']);

    });
});
