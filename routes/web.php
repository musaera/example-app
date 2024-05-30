<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
