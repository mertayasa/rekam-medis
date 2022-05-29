<?php

use App\Http\Controllers\ProfileController;
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
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function (){
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::patch('update', [ProfileController::class, 'update'])->name('update');
        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::get('edit-password', [ProfileController::class, 'editPassword'])->name('edit_password');
        Route::patch('update-password', [ProfileController::class, 'updatePassword'])->name('update_password');
        Route::get('/{page?}', [ProfileController::class, 'index'])->name('index');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
