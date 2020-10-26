<?php

use Illuminate\Support\Facades\Route;

use App\Events\FormSubmitted;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sender', function () {
    return view('sender');
});

Route::post('/sender', function () {
    
    $message = request()->message;
    echo $message;
    event(new FormSubmitted($message));

});