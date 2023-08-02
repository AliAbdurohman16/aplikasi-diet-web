<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::middleware('role:admin')->group(function () {
    Route::get('dashboard', [Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'categories' => Backend\CategoryController::class,
        'subcategories' => Backend\SubcategoryController::class,
        'foods' => Backend\FoodController::class,
        'drinks' => Backend\DrinkController::class,
        'sports' => Backend\SportController::class,
        'consultations' => Backend\ConsultationController::class,
        'users' => Backend\UserController::class,
        'profile' => Backend\ProfileController::class,
        'change-password' => Backend\ChangePasswordController::class,
    ]);
});

Route::get('/passport', function () {
    \Illuminate\Support\Facades\Artisan::call('passport:install');
    echo 'generated';
});
