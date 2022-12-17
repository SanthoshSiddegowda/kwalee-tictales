<?php

use App\Http\Controllers\v1\CategoryController;
use App\Http\Controllers\v1\OrderController;
use App\Http\Controllers\v1\UserAvatarController;
use App\Http\Controllers\v1\UserController;
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

Route::get('get-all-categories', [CategoryController::class, 'index']);
Route::get('/{id}/get-my-avatar', [UserController::class, 'show']); //ID can be replaced with uuid in future

Route::post('/avatar/add', [OrderController::class, 'add']);
Route::post('/user-avatar/sequence', [UserAvatarController::class, 'sequence']);
