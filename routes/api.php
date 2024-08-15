<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

route::post('/login', [AuthController::class, 'login']);
route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

route::group(['middleware' => 'auth:api', 'prefix' => 'users'], function () {
    route::get('/', [UserController::class, 'index']);
    route::get('/{id}', [UserController::class, 'show']);
    route::post('/', [UserController::class, 'store']);
    route::put('/{id}', [UserController::class, 'update']);
    route::delete('/delete/{id}', [UserController::class, 'delete']);
});

route::group(['middleware' => 'auth:api', 'prefix' => 'clients'], function () {
    route::get('/', [ClientController::class, 'index']);
    route::get('/{id}', [ClientController::class, 'show']);
    route::post('/', [ClientController::class, 'store']);
    route::put('/{id}', [ClientController::class, 'update']);
    route::delete('/delete/{id}', [ClientController::class, 'delete']);
});

route::group(['middleware' => 'auth:api', 'prefix' => 'products'], function () {
    route::get('/', [ProductController::class, 'index']);
    route::get('/{id}', [ProductController::class, 'show']);
    route::get('/client/{client_id}', [ProductController::class, 'filterByClient']);
    route::post('/', [ProductController::class, 'store']);
    route::put('/{id}', [ProductController::class, 'update']);
    route::delete('/delete/{id}', [ProductController::class, 'delete']);
});
