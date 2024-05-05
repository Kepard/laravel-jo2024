<?php

use Illuminate\Support\Facades\Route;
use App\Models\Competition;
use App\Http\Controllers\Admin\CompetitionController;
use App\Http\Controllers\Admin\SportController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\SpectatorController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompetitionsController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('cart/save-to-db', [CartController::class, 'saveToDB'])->name('cart.save-to-db');

Route::get('/competitions', [CompetitionsController::class, 'index'])->name('competitions');

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout',[AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('competition', CompetitionController::class)->except(['show']);
    Route::resource('sport', SportController::class)->except(['show']);
    Route::resource('location', LocationController::class)->except(['show']);
    Route::resource('spectator', SpectatorController::class)->except(['show']);
});
