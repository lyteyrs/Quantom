<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('login/google', [LoginController::class, 'google']);
Route::get('login/google/callback', [LoginController::class, 'googleRedirect']);

Route::get('login/facebook', [LoginController::class, 'facebook']);
Route::get('login/facebook/callback', [LoginController::class, 'facebookRedirect']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');