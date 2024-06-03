<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BeritaController;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/item', [HomeController::class, 'item']);

Route::controller(KategoriController::class)->group(function () {
    Route::get('/kategori', 'index')->name('kategori');
    Route::get('/kategori-create', 'create')->name('kategori.create');
    Route::post('/kategori', 'store')->name('kategori.perform');
    Route::get('/kategori-edit/{id}', 'edit')->name('kategori.edit');
    Route::put('/kategori-update/{id}', 'update')->name('kategori.update');
    Route::delete('/kategori-delete/{id}', 'destroy')->name('kategori.delete');
});

Route::controller(SiswaController::class)->group(function () {
    Route::get('/siswa', 'index')->name('siswa');
    Route::get('/siswa-create', 'create')->name('siswa.create');
    Route::post('/siswa', 'store')->name('siswa.perform');
    Route::get('/siswa-edit/{id}', 'edit')->name('siswa.edit');
    Route::put('/siswa-update/{id}', 'update')->name('siswa.update');
    Route::delete('/siswa-delete/{id}', 'destroy')->name('siswa.delete');
});

Route::controller(BeritaController::class)->group(function () {
    Route::get('/berita', 'index')->name('berita');
    Route::get('/berita-create', 'create')->name('berita.create');
    Route::post('/berita', 'store')->name('berita.perform');
    Route::get('/berita-edit/{id}', 'edit')->name('berita.edit');
    Route::put('/berita-update/{id}', 'update')->name('berita.update');
    Route::delete('/berita-delete/{id}', 'destroy')->name('berita.delete');
});
