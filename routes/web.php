<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
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


Route::get('/', [AuthController::class, 'index'])->name('index');
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'home', 'middleware' => 'LoginMiddleware'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/author/{id}', [AuthorController::class, 'show'])->name('author.view')->where(['id' => '[0-9]+']);
    Route::get('/author', function () {
        return view('author.create');
    })->name('author.create');
    Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
    Route::delete('/author/{id}', [AuthorController::class, 'delete'])->name('author.delete');

    Route::delete('/book/{id}/author/{author_id}', [BookController::class, 'delete'])->name('book.delete');
    Route::get('/create/book', [BookController::class, 'create'])->name('book.create');
    Route::post('/store/book', [BookController::class, 'store'])->name('book.store');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

});

