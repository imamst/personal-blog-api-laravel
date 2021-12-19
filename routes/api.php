<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    Admin\UserController,
    Admin\UserStatusController,
    Author\PostController as AuthorPostController,
    Guest\TagListController,
    Guest\CategoryListController,
    Guest\PostController,
    Guest\PostFilterController,
    AuthController,
    TokenController,
    TagController,
    CategoryController,
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

Route::prefix('/public')->group(function() {
    // Guest
    Route::get('/tags', TagListController::class);
    Route::get('/categories', CategoryListController::class);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post:slug}', [PostController::class, 'show']);
    Route::get('tags/{tag}/posts', [PostFilterController::class, 'indexByTag']);
    Route::get('categories/{category}/posts', [PostFilterController::class, 'indexByCategory']);
    Route::get('authors/{author}/posts', [PostFilterController::class, 'indexByAuthor']);
    Route::get('{year}/{month}/posts', [PostFilterController::class, 'indexByMonthAndYear']);
    Route::get('search/posts', [PostFilterController::class, 'search']);
});

// Author & Admin
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/clear/token', [TokenController::class, 'clear']);
    Route::apiResource('/tags', TagController::class);
    Route::apiResource('/categories', CategoryController::class);
});

Route::middleware(['auth:sanctum', 'ability:admin'])->group(function() {
    // Admin
    Route::apiResource('/users', UserController::class)->only(['index', 'show']);
    Route::patch('/users/{user}/suspend', [UserStatusController::class, 'suspend']);
    Route::patch('/users/{user}/unsuspend', [UserStatusController::class, 'unsuspend']);
});

// Author
Route::middleware(['auth:sanctum', 'ability:author'])->group(function() {
    Route::apiResource('posts', AuthorPostController::class);
    Route::post('posts/draft', [AuthorPostController::class, 'storeAsDraft']);
});
