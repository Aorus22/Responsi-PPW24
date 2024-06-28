<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;

Route::resource('barang', BarangController::class);

Route::get('/', function () {
    return view('home');
});

Route::get('/kasir', [BarangController::class, 'kasirIndex'])->name('kasir');
Route::post('/add-to-cart', [KeranjangController::class, 'addToCart'])->name('addToCart');
Route::get('/keranjang', [KeranjangController::class, 'showCart'])->name('keranjang');
Route::post('/remove-from-cart', [KeranjangController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/update-cart-item', [KeranjangController::class, 'updateCartItem'])->name('updateCartItem');
Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('checkout');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class);
});
