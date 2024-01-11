<?php

use App\Http\Controllers\EditArticlePage;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', [HomePageController::class, 'index'])->name('mainPage');
Route::get('/page', [PageController::class, 'pageCategory'])->name('pageCategory');
Route::get('/news-{id}', [PageController::class, 'index'])->name('page');
Route::get('/category/{id}/{category}', [PageController::class, 'postsByCategory'])->name('postsByCategory');
Route::get('/search', [PageController::class, 'search'])->name('search');
Route::get('/feed', [PageController::class, 'feed'])->name('feed');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('adminPanel');
        Route::get('/search', [AdminController::class, 'searchArticle'])->name('searchArticle');
        Route::get('/new_post', [ArticleController::class, 'index'])->name('new_post');
        Route::post('/save_new_post', [ArticleController::class, 'store'])->name('save_new_post');
        Route::get('/delete_post/{id}', [ArticleController::class, 'delete'])->name('delete_post');
        Route::get('/edit_post/{id}', [EditArticlePage::class, 'edit_page'])->name('edit_page');
        Route::post('/edit_post/{id}/update', [EditArticlePage::class, 'store_updatedPost'])->name('store_updatedPost');
        Route::delete('/delete_image/{id}', [EditArticlePage::class, 'delete_image'])->name('delete_image');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/newCategory', [CategoryController::class, 'index'])->name('newCategory');
        Route::post('/addNewCategory', [CategoryController::class, 'store'])->name('addNewCategory');
        Route::get('/deleteCategory', [CategoryController::class, 'delete'])->name('deleteCategory');
        Route::get('/addMediaIcons', [AdminController::class, 'addMediaIcons'])->name('addMediaIcons');
        Route::post('/addIcon', [AdminController::class, 'addIcon'])->name('addIcon');
        Route::post('/deleteMediaIcon', [AdminController::class, 'deleteMediaIcon'])->name('deleteMediaIcon');
        Route::post('/addContacts', [AdminController::class, 'addContacts'])->name('addContacts');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::prefix('admin')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
//});

require __DIR__.'/auth.php';
