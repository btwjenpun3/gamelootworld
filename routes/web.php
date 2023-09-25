<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SingleBlogController;
use App\Http\Controllers\Fetch\FetchController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// ---------------------------------------//
// !!----------- Home Route -----------!! //
Route::get('/', [HomeController::class, 'index'])->name('index');

// !!----------- Admin Route -----------!! //
Route::get('/auth/private/admin/login', [AdminController::class, 'loginForm'])->name('loginAdminForm');

Route::post('/auth/private/admin/login', [AdminController::class, 'loginProccess'])->name('loginAdminProccess');

Route::get('/auth/private/admin', [AdminController::class, 'index'])->name('indexAdmin');

Route::get('/auth/private/admin/posts', [AdminController::class, 'posts'])->name('indexAdminPosts');

Route::get('/auth/private/admin/posts/{id}', [AdminController::class, 'postEdit'])->name('indexAdminPostEdit');

Route::post('/auth/private/admin/post/{id}', [AdminController::class, 'postEditProcess'])->name('indexAdminPostEditProcess');

// !!----------- Blog Route -----------!! //
Route::get('/all/games', [BlogController::class, 'allIndex'])->name('allIndex');

Route::get('/all/dlcs', [BlogController::class, 'allDlcIndex'])->name('allDlcIndex');

Route::get('/steam', [BlogController::class, 'steamIndex'])->name('steamIndex');

Route::get('/epic', [BlogController::class, 'epicIndex'])->name('epicIndex');

Route::get('/gog', [BlogController::class, 'gogIndex'])->name('gogIndex');

// !!----------- Single Blog Route -----------!! //
Route::get('/{slug}', [SingleBlogController::class, 'index'])->name('singleBlog');

// ---------------------------------------//
// !!----------- Fetch Route -----------!! //
Route::get('/data/fetch', [FetchController::class, 'fetchGameContentFromUpstream'])->name('fetchPostsFromUpstream');

Route::get('/data/update', [FetchController::class, 'updateGameContentFromUpstream'])->name('updatePostsFromUpstream');

// Route::get('/data/reupdate', [FetchController::class, 'reUpdateGameContentFromUpstream'])->name('reUpdatePostsFromUpstream');

// ---------------------------------------//
// !!----------- Redirect Route -----------!! //
Route::get('/go/{url}', [UrlController::class, 'urlRedirect']);