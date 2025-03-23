<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('animations');
});

Route::get('/vue', function () {
    return view('vue');
});

Route::get('/animations', function () {
    return view('animations');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/cgvs', function () {
    return view('cgvs');
})->name('cgvs');