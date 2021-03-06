<?php

use App\Http\Controllers\BookmarkController;
use App\Models\User;
use App\Models\userFavorite;
use App\Http\Controllers\news;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use App\Models\Bookmarks;
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

/*
    middleware: guest, auth means that if a user trying to get in the route directly using url 
    it wont allow and it will redirect to specific page 
    example: middleware('auth') means this route only allow a authenticate user to assess.
    Its the same when it goes to middleware('guest)
*/ 

Route::get('/', [news::class, 'getTopHeadlines']);

Route::get('/category/{category}', [news::class, 'getByCategory']);

// View single news
Route::post('/article/news', [news::class, 'getArticles']);
// Bookmark news articles
Route::post('/bookmark/article', [BookmarkController::class, 'store']);

// User show login
Route::get('/login', [UserController::class, 'login'])->name(('login'))->middleware('guest');
// Show register page to user 
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
// Create a new users
Route::post('/register/newUser', [UserController::class, 'store']);

// Users logging out
Route::post('/users/logout', [UserController::class, 'logout'])->middleware('auth');

// Sign in users
Route::post('/users/login/authenticate', [UserController::class, 'authenticate']);

// Get auth users bookmark
Route::get('/users/bookmark', [BookmarkController::class, 'show'])->middleware('auth'); 
// Currently there are no button to this route


// Oauth provider login
Route::get('/auth/google', [ProviderController::class, 'redirectToGoogle'])->middleware('guest');
Route::get('/auth/google/callback', [ProviderController::class, 'handle'])->middleware('guest');

// Search box
Route::post('/search/news', [news::class, 'searchNews']);

// For pagination 
Route::post('/page/{currentPage}', [PaginationController::class, 'getPage']);

// For changing the lang
Route::post('/lang', [PaginationController::class, 'getLang']);

// Page route for the categories
Route::get('/category/{category}/{page}', [PaginationController::class, 'getCategoryByPage']);






// Testing
Route::get("/home/{category}/{lang}/{articles}/{page}/{totalPages}", [news::class, 'getLatest']); // AJAX success route
Route::post('/getLatest', [news::class, 'getAPINews']); //AJAX route
// simulate home
Route::get("/simulateHome", [news::class, 'getNews']);