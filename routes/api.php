<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    Admin\UserController,
    Admin\UserStatusController,
    TagController,
    CategoryController
};

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

Route::prefix('admin')->group(function() {
    Route::apiResource('users', UserController::class)->only(['index', 'show']);
    Route::patch('users/{user}/suspend', [UserStatusController::class, 'suspend']);
    Route::patch('users/{user}/unsuspend', [UserStatusController::class, 'unsuspend']);
});

Route::apiResource('tags', TagController::class);
Route::apiResource('categories', CategoryController::class);
