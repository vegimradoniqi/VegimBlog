<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationController;
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
Route::post('/register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/email-verification', [VerificationController::class, 'verify'])->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/authenticated', function () {
        return true;
    });
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/blog-handle', [BlogController::class, 'blogHandle']);
    Route::get('/blog-like/{id}', [LikeController::class, 'likePost']);
});

Route::get('/check-login', [LoginController::class, 'checkLogin']);
Route::post('/get-all-blogs', [BlogController::class, 'getAllBlogs']);
Route::get('/get-blog-category', [BlogController::class, 'getBlogByCategory']);
Route::get('/filter-blog', [BlogController::class, 'filterBlog']);

