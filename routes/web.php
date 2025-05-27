<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/billion-doller', function () {
    return view('games.billion-doller');
});


