<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[NewsController::class,'index'])->name('news.index');

Route::get('/news/create',[NewsController::class,'create'])->name('news.create');

Route::post('/news',[NewsController::class,'store'])->name('news.store');

Route::get('/news/{news}/edit',[NewsController::class,'edit'])->name('news.edit');

Route::put('/news/{news}',[NewsController::class,'update'])->name('news.edit');

Route::delete('/news/{news}',[NewsController::class,'destroy'])->name('news.destroy');
