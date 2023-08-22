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
    Route::post('logout', [AuthController::class, 'logout']);

    Route::resources([
        'categories' => CategoryController::class,
        'subcategories' => SubcategoryController::class,
        'foods' => FoodController::class,
        'drinks' => DrinkController::class,
    ]);
});
