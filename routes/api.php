<?php

use App\Http\Controllers\API\DrinkController;
use App\Http\Controllers\API\SubcategoryController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('foods', [API\FoodController::class, 'index']);
    Route::post('foods', [API\FoodController::class, 'store']);
    Route::get('snacks', [API\SnackController::class, 'index']);
    Route::post('snacks', [API\SnackController::class, 'store']);
    Route::get('drinks', [API\DrinkController::class, 'index']);
    Route::get('sports', [API\SportController::class, 'index']);
    Route::get('educations', [API\EducationController::class, 'index']);
    Route::get('anthropometry', [API\AnthropometryController::class, 'index']);
    Route::get('profile', [API\ProfileController::class, 'index']);
    Route::put('profile', [API\ProfileController::class, 'update']);
    Route::post('logout', [API\AuthController::class, 'logout']);
});
