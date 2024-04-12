<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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

Route::group(['controller' => AuthController::class], function() {
    Route::middleware('guest')->group(function (){
        Route::get('login', 'showLoginForm')->name('login.index');
        Route::get('register', 'showRegisterForm')->name('register.index');
        
        Route::post('login', 'login')->name('login.authenticate');
        Route::post('register', 'register')->name('register.create');
    });

    Route::get('logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('role:Admin,BK,Guru,Kepala Sekolah')->group(function() {
        Route::middleware('role:Admin')->group(function () {
            Route::resource('siswa', SiswaController::class);
            Route::resource('guru', GuruController::class);
        });
        
        Route::resource('siswa', SiswaController::class)->only('index');
        Route::resource('guru', GuruController::class)->only('index');
    });

    
    Route::post('pelanggaran/cetak', [PelanggaranController::class, 'cetak'])->name('pelanggaran.cetak');
    Route::middleware('role:BK')->group(function () {
        Route::resource('pelanggaran', PelanggaranController::class);
    });
    Route::resource('pelanggaran', PelanggaranController::class)->only('index');
    

    Route::post('bimbingan/cetak', [BimbinganController::class, 'cetak'])->name('bimbingan.cetak');
    Route::middleware('role:BK')->group(function () {
        Route::resource('bimbingan', BimbinganController::class);
    });
    Route::resource('bimbingan', BimbinganController::class)->only('index');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error.404');
})->where('page','.*');
