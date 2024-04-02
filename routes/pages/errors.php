<?php

use Illuminate\Support\Facades\Route;

Route::get('/403_error', function () {
    return view('errors/403_error');
})->name('error403');

Route::get('/404_error', function () {
    return view('errors/404_error');
})->name('error404');

Route::get('/503_error', function () {
    return view('errors/503_error');
})->name('error503');

Route::fallback(function () {
    return view('errors/404_error');
});