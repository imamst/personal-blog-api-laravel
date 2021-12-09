<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    Admin\UserController,
    Admin\UserStatusController,
    Guest\TagListController,
    Guest\CategoryListController,
    AuthController,
    TokenController,
    TagController,
    CategoryController,
    PostController
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/clear/token', [TokenController::class, 'clear']);
});

// Admin
Route::apiResource('/users', UserController::class)->only(['index', 'show']);
Route::patch('/users/{user}/suspend', [UserStatusController::class, 'suspend']);
Route::patch('/users/{user}/unsuspend', [UserStatusController::class, 'unsuspend']);

// Author

// Author & Admin
Route::apiResource('/tags', TagController::class);
Route::apiResource('/categories', CategoryController::class);

Route::prefix('/public')->group(function() {
    // Guest
    Route::get('/tags', TagListController::class);
    Route::get('/categories', CategoryListController::class);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post:slug}', [PostController::class, 'show']);
});
