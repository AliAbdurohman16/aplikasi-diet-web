<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middlewares\RoleMiddleware;
use App\Http\Controllers\API;

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

Route::post('register', [API\AuthController::class, 'register']);
Route::post('login', [API\AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [API\AuthController::class, 'logout']);
    Route::get('categories', [API\CategoryController::class, 'index']);
    Route::get('subcategories', [API\SubcategoryController::class, 'index']);
    Route::get('foods', [API\FoodController::class, 'index']);
    Route::get('drinks', [API\DrinkController::class, 'index']);
    Route::get('sports', [API\SportController::class, 'index']);
    Route::get('educations', [API\EducationController::class, 'index']);
});
