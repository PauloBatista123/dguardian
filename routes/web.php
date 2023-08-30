<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:passport')->group(function() {
    Route::get('/', function () {
        return view('welcome');
    });
});

Auth::routes([
    'register' => false, 'reset' => false,
]);

Route::get('/oauth/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/microsoft/redirect', [LoginController::class, 'loginMicrosoft'])->name('login.microsoft');
Route::get('/auth/microsoft/callback', [LoginController::class, 'loginMicrosoftCallback'])->name('login.microsoft.callback');
