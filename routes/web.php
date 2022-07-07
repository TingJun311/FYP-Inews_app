<?php

use App\Models\User;
use App\Models\userFavorite;
use App\Http\Controllers\news;
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

Route::get('/', [news::class, 'getEverything']);

// Route::get('/test', [news::class, 'get'])
