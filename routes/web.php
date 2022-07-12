<?php

use App\Models\User;
use App\Models\userFavorite;
use App\Http\Controllers\news;
use App\Http\Controllers\UserController;
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

Route::get('/', [news::class, 'getTopHeadlines']);

Route::get('/category/{category}', [news::class, 'getByCategory']);

// User show login
Route::get('/login', [UserController::class, 'login']);
// Show register page to user 
Route::get('/register', [UserController::class, 'register']);
// Create a new users
Route::post('/register/newUser', [UserController::class, 'store']);

// Users logging out
Route::post('/users/logout', [UserController::class, 'logout']);

// Sign in users
Route::post('/users/login/authenticate', [UserController::class, 'authenticate']);
