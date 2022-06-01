<?php

use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
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
        Route::get('/', [ProfileController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'pasien', 'as' => 'pasien.'], function () {
        Route::get('/', [PasienController::class, 'index'])->name('index');
        Route::get('find/{pasien}', [PasienController::class, 'find'])->name('find');
        Route::get('datatable', [PasienController::class, 'datatable'])->name('datatable');
        Route::get('create', [PasienController::class, 'create'])->name('create');
        Route::post('store', [PasienController::class, 'store'])->name('store');
        Route::get('edit', [PasienController::class, 'edit'])->name('edit');
        Route::patch('update', [PasienController::class, 'update'])->name('update');
        Route::delete('destroy/{pasien}', [PasienController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'rekam-medis', 'as' => 'rekam.'], function () {
        Route::group(['prefix' => 'edit'], function () {
            Route::get('pengkajian/{pasien}', [RekamMedisController::class, 'editPengkajian'])->name('edit_pengkajian');
            Route::get('diagnosa/{pasien}', [RekamMedisController::class, 'editDiagnosa'])->name('edit_diagnosa');
            Route::get('luaran/{pasien}', [RekamMedisController::class, 'editLuaran'])->name('edit_luaran');
            Route::get('evaluasi/{pasien}', [RekamMedisController::class, 'editEvaluasi'])->name('edit_evaluasi');
        });

        Route::group(['prefix' => 'update'], function () {
            Route::patch('pengkajian/{pasien}', [RekamMedisController::class, 'updatePengkajian'])->name('update_pengkajian');
            Route::patch('diagnosa/{pasien}', [RekamMedisController::class, 'updateDiagnosa'])->name('update_diagnosa');
            Route::patch('luaran/{pasien}', [RekamMedisController::class, 'updateLuaran'])->name('update_luaran');
            Route::patch('evaluasi/{pasien}', [RekamMedisController::class, 'updateEvaluasi'])->name('update_evaluasi');
        });
    });
});

Route::group(['prefix' => 'rekam-medis-intervensi', 'as' => 'rekam_intervensi.'], function () {
    Route::patch('pengkajian/{pasien}', [RekamMedisController::class, 'updatePengkajian'])->name('update_pengkajian');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
