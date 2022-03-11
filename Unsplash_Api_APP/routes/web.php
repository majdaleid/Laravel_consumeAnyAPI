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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('authorization', [App\Http\Controllers\Auth\LoginController::class, 'authorization'])->name('authorization');

//Route::get('/', [App\Http\Controllers\WelcomeController::class, 'ShowWelcomePage'])->name('welcome');

Route::get('/{title}-{id}', [App\Http\Controllers\ProductController::class, 'ShowProduct'])->name('products.show');




//Unsplash API

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'ShowWelcomePage'])->name('homeAPI');


//Route::get('https://unsplash.com/oauth/authorize/native', [App\Http\Controllers\Auth\LoginController::class, 'authorization'])->name('authorization');


Route::get('/SearchUserInfo', [App\Http\Controllers\ProductController::class, 'ShowgivenUserInfo'])->name('showgivenUserInfo');





Route::get('/users/{username}/statistics', [App\Http\Controllers\ProductController::class, 'ShowgivenUserStatistics'])->where('username', '.*')->name('ShowgivenUserStatistics');

Route::get('/photos/{id}/statistics', [App\Http\Controllers\ProductController::class, 'ShowgivenPhotoStatistics'])->name('ShowgivenPhotoStatistics');

//GET /photos/:id/statistics