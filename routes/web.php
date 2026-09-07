<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('home');
});

