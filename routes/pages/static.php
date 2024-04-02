<?php

use Illuminate\Support\Facades\Route;

Route::get('/contacts', function () {
  return view('static.contacts');
})->name('contacts');
Route::get('/company', function () {
  return view('static.company');
})->name('company');
Route::get('/privacy', function () {
  return view('static.privacy');
})->name('privacy');