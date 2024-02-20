<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;

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

// Route::get('/', function () {
//     return view('peminjaman.index');
// });

Route::get('/', [PeminjamanController::class, 'index'])->name('siswa.index');

Route::resource('siswa', SiswaController::class);
Route::resource('barang', BarangController::class);
Route::resource('peminjaman', PeminjamanController::class);