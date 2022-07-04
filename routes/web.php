<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\KurimatkulController;

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
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);

    Route::put('matkul/{kurikulum}/kurikulum', [MatkulController::class, 'matkulUpdate'])->name('matkul.matkulUpdate');
    Route::resource('matkul', MatkulController::class);

    Route::get('kurikulum/{kurikulum}/matkul', [KurikulumController::class, 'mataKuliah'])->name('kurikulum.matkul');
    Route::resource('kurikulum', KurikulumController::class);

    Route::post('mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
    Route::resource('mahasiswa', MahasiswaController::class);


    Route::resource('kompetensi', KompetensiController::class);
    Route::resource('nilai', NilaiController::class);
    Route::resource('kurimatkul', KurimatkulController::class);
});
