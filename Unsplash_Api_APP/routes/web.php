<?php


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


Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [App\Http\Controllers\UserController::class, 'searchUser'])->name('searchUser');

Route::get('authorization', [App\Http\Controllers\Auth\LoginController::class, 'authorization'])->name('authorization');

Route::get('/SearchUserInfo', [App\Http\Controllers\UserController::class, 'ShowgivenUserInfo'])->name('showgivenUserInfo');

Route::get('/users/{username}/statistics', [App\Http\Controllers\UserController::class, 'ShowgivenUserStatistics'])->where('username', '.*')->name('ShowgivenUserStatistics');

Route::get('/', [App\Http\Controllers\PhotoController::class, 'ShowPhotos'])->name('homeAPI');

Route::get('/photos/{id}/statistics', [App\Http\Controllers\PhotoController::class, 'ShowgivenPhotoStatistics'])->name('ShowgivenPhotoStatistics');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'DashboardIndex'])->name('DashboardIndex');