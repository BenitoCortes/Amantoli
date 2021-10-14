<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReactController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('ordersapi/{order}', [ReactController::class, 'ordersUsers']);
Route::post('registernewuser', [ReactController::class, 'registernewuser']);
Route::post('loginuser', [ReactController::class, 'login']);
Route::get('products', [ReactController::class, 'products']);
Route::get('searchproduct', [ReactController::class, 'searchproducts']);
//http://amantoliv2.test/api/searchproduct?name=lorem