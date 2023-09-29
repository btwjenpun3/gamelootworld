<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SingleBlogController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Fetch\FetchController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\CollectionController;
use App\Http\Controllers\Admin\AdminCommentController;

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

// !!----------- Homepage Route -----------!! //
Route::prefix('/')
    ->name('home.')
    ->controller(HomeController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index');        
    });

    Route::prefix('/loots')
            ->name('loots.')
            ->controller(BlogController::class)
            ->group(function() {
                Route::get('/all/games', 'games')->name('games');
                Route::get('/all/dlcs', 'dlcs')->name('dlcs');
                Route::get('/steam', 'steam')->name('steam');
                Route::get('/epic', 'epic')->name('epic');
                Route::get('/gog', 'gog')->name('gog');
            });
    
    Route::prefix('/')
        ->name('loot.')
        ->controller(SingleBlogController::class)
        ->group(function() {
            Route::get('/{slug}', 'index')->name('index');       
        });
    

// !!----------- Admin Route -----------!! //
Route::prefix('/auth/private/admin')
    ->name('admin.')
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/login', 'index')->name('index');
        Route::post('/login', 'login')->name('login');
        Route::get('/', 'dashboard')->name('dashboard')->middleware('isadmin');        
    });

    Route::prefix('/auth/private/admin/posts')
        ->name('admin.posts.')
        ->middleware('isadmin')
        ->controller(PostController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
        });

    Route::prefix('/auth/private/admin/comments')
        ->name('admin.comments.')
        ->middleware('isadmin')
        ->controller(AdminCommentController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
        });

    Route::prefix('/auth/private/admin/tools')
        ->name('admin.tools.')
        ->middleware('isadmin')
        ->controller(ToolController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/update/status', 'updateStatus')->name('update_status');
        });

    Route::prefix('/auth/private/admin/tools')
        ->name('admin.tools.fetch.')
        ->middleware('isadmin')
        ->controller(FetchController::class)
        ->group(function() {
            Route::get('/fetch', 'fetchGameContentFromUpstream')->name('all');
            Route::get('/fetch/{source_id?}', 'fetchGameContentUsingId')->name('id');
            Route::get('/fetch/get/update', 'updateGameContentFromUpstream')->name('update');
        });

    Route::prefix('/auth/private/admin/user')
        ->name('admin.user.')
        ->middleware('isadmin')
        ->controller(UserController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('update');
        });        

// !!----------- Redirect Route -----------!! //
Route::get('/go/{url}', [UrlController::class, 'urlRedirect']);

// !!----------- User Route -----------!! //
Route::prefix('/user')
    ->name('login.')
    ->controller(LoginController::class)
    ->group(function() {
        Route::get('/login', 'index')->name('index');
        Route::post('/login', 'login')->name('login');
        Route::get('/logout', 'logout')->name('logout')->middleware('ismember');
    });

Route::prefix('/user/register')
    ->name('register.')
    ->controller(RegisterController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });

Route::prefix('/user/collection')
    ->name('collection.')
    ->middleware('ismember')
    ->controller(CollectionController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/add/{id}', 'add')->name('add');
    });

Route::prefix('/user/comment')
    ->name('comment.')
    ->middleware('ismember')
    ->controller(CommentController::class)
    ->group(function() {
        Route::post('/{id}', 'store')->name('store');
    });