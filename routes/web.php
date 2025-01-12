<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

Route::group (['prefix'=>'blog'], function(){
    Route::get ('/master', [BlogController::class, 'master'])->name('master');
    Route::get('/list',[BlogController::class, 'list'])->name('list');
    Route::post('/formCreate', [BlogController::class, 'formCreate'])->name('formCreate');
    Route::get('/delete/{id}', [BlogController::class, 'delete'])->name('delete');
    Route::get('/update/{id}', [BlogController::class, 'update'])->name('update');
    Route::post('/formUpdate/{id}', [BlogController::class, 'formUpdate'])->name('formUpdate');
});
