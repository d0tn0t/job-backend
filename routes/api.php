<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register',[AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', ['middleware' => 'auth:api'], [AuthController::class, 'refresh']);
Route::post('logout', ['middleware' => 'auth:api'], [AuthController::class, 'logout']);

Route::prefix('category')->middleware('auth:api')->group(function () {
    Route::post('/register', [CategoryController::class, 'register']);
    Route::get('/', [CategoryController::class, 'getList']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'remove']);
});


Route::prefix('product')->middleware('auth:api')->group(function () {
    Route::post('/register', [ProductController::class, 'register']);
    Route::get('/', [ProductController::class, 'getList']);
    Route::post('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'remove']);
});