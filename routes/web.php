<?php

use Illuminate\Support\Facades\Route;

use App\Events\FormSubmitted;
use App\Events\FormSubmittedRefresh;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index']);

// News
Route::resource('/slides', SlideController::class);
Route::get('slides/delete/{id}','App\Http\Controllers\SlideController@delete');
Route::post('slides/file/{method}','App\Http\Controllers\SlideController@file');
// News Front
Route::resource('/front-news', FrontNewsController::class);

Route::get('/sender', function () {
    return view('sender');
});

Route::post('/sender', function () {
    
    $message = request()->message;
    echo $message;
    event(new FormSubmitted($message));
    return redirect('/slides');

});

Route::post('/refresh', function () {
    
    $msg = request()->msg;
    echo $msg;
    event(new FormSubmittedRefresh($msg));
    return redirect('/slides');

});