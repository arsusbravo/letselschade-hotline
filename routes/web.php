<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/diensten', function () {
    return view('diensten');
});

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'show'])->name('contact');

Route::get('/letselschadetest', function () {
    return view('letselschadetest');
});

Route::post('/letselschade/submit', [App\Http\Controllers\LetselschadeController::class, 'submit'])->name('letselschade.submit');
Route::post('/contact/submit', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

Route::get('/thank-you', [App\Http\Controllers\LetselschadeController::class, 'thankYou'])->name('thank-you');

// Webreaction API routes
Route::post('/webreaction/contact', [App\Http\Controllers\WebreactionController::class, 'contact'])->name('webreaction.contact');
Route::post('/webreaction/store', [App\Http\Controllers\WebreactionController::class, 'store'])->name('webreaction.store');
