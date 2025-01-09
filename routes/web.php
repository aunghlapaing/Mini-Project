<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

Route::group (['prefix'=>'blog'], function(){
    Route::get ('/master', [BlogController::class, 'master'])->name('master');
    Route::get('/list',[BlogController::class, 'list'])->name('list');
});
