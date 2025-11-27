<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProdcutController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function (){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('products', ProdcutController::class);
    Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
});
