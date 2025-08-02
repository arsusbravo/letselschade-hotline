<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/diensten', function () {
    return view('diensten');
});

Route::get('/contact', function () {
    return view('contact');
});
