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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/files-json', [App\Http\Controllers\FileController::class, 'index'])->name('files.json');
Route::get('/files-download/{id}', [App\Http\Controllers\FileController::class, 'download'])->name('files.download');
Route::get('/files-delete/{id}', [App\Http\Controllers\FileController::class, 'destroy'])->name('files.delete');

Route::post('/files-post', [App\Http\Controllers\FileController::class, 'store'])->name('file.post');
