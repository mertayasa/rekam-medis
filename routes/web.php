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

Route::group(['middleware' => ['auth', 'verified']], function (){
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
        Route::get('edit/{pasien}', [PasienController::class, 'edit'])->name('edit');
        Route::get('set-keluar/{pasien}', [PasienController::class, 'setKeluar'])->name('set_keluar');
        Route::patch('update/{pasien}', [PasienController::class, 'update'])->name('update');
        Route::delete('destroy/{pasien}', [PasienController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'rekam-medis', 'as' => 'rekam.'], function () {
        Route::group(['prefix' => 'edit'], function () {
            Route::get('pengkajian/{pasien}', [RekamMedisController::class, 'editPengkajian'])->name('edit_pengkajian');
            Route::get('diagnosa/{pasien}', [RekamMedisController::class, 'editDiagnosa'])->name('edit_diagnosa');
            Route::get('luaran/{pasien}', [RekamMedisController::class, 'editLuaran'])->name('edit_luaran');
            Route::get('implementasi/{pasien?}', [RekamMedisController::class, 'editImplementasi'])->name('edit_implementasi');
            Route::get('get-implementasi/{pasien}', [RekamMedisController::class, 'getImplementasi'])->name('get_implementasi');
            Route::get('evaluasi/{pasien?}', [RekamMedisController::class, 'editEvaluasi'])->name('edit_evaluasi');
            Route::get('get-evaluasi/{pasien}', [RekamMedisController::class, 'getEvaluasi'])->name('get_evaluasi');
        });
        
        Route::group(['prefix' => 'show'], function () {
            Route::get('{pasien}', [RekamMedisController::class, 'lihatDetail'])->name('show_detail');
        });
        
        Route::group(['prefix' => 'print'], function () {
            Route::get('{pasien}', [RekamMedisController::class, 'print'])->name('print');
        });
        
        Route::group(['prefix' => 'update'], function () {
            Route::patch('pengkajian/{pasien}', [RekamMedisController::class, 'updatePengkajian'])->name('update_pengkajian');
            Route::patch('diagnosa/{pasien}', [RekamMedisController::class, 'updateDiagnosa'])->name('update_diagnosa');
            Route::patch('luaran/{pasien}', [RekamMedisController::class, 'updateLuaran'])->name('update_luaran');
            Route::patch('implementasi/{pasien}', [RekamMedisController::class, 'updateImplementasi'])->name('update_implementasi');
            Route::patch('evaluasi/{pasien}', [RekamMedisController::class, 'updateEvaluasi'])->name('update_evaluasi');
        });
    });
});

Route::group(['prefix' => 'rekam-medis-intervensi', 'as' => 'rekam_intervensi.'], function () {
    Route::get('{pasien}', [RekamMedisController::class, 'publicLink'])->name('share');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
