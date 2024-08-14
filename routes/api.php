<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::group(['prefix' => 'clients'], function () {
    route::get('/', [ClientController::class, 'index']);
    route::get('/{id}', [ClientController::class, 'show']);
    route::post('/', [ClientController::class, 'store']);
    route::put('/{id}', [ClientController::class, 'update']);
    route::delete('/delete/{id}', [ClientController::class, 'delete']);
});

route::group(['prefix' => 'products'], function () {
    route::get('/', [ProductController::class, 'index']);
    route::get('/{id}', [ProductController::class, 'show']);
    route::get('/client/{client_id}', [ProductController::class, 'filterByClient']);
    route::post('/', [ProductController::class, 'store']);
    route::put('/{id}', [ProductController::class, 'update']);
    route::delete('/delete/{id}', [ProductController::class, 'delete']);
});
