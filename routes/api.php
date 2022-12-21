<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\UserController;

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

Route::apiResource('inventories', InventoryController::class);

Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('{product_id}/{unit_id?}', 'show');
}); 

Route::apiResource('images', ImageController::class);
Route::apiResource('users', UserController::class);
