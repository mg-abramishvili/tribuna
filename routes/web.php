<?php

use Illuminate\Support\Facades\Route;

use App\Events\FormSubmitted;
use App\Http\Controllers\SlideController;

Route::get('/', [SlideController::class, 'index']);

Route::get('/sender', function () {
    return view('sender');
});

Route::post('/sender', function () {
    
    $message = request()->message;
    echo $message;
    event(new FormSubmitted($message));

});