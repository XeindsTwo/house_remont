<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['checkdb'])->prefix('reviews')->group(function () {
  Route::get('/', [ReviewController::class, 'index'])->name('reviews');

  Route::middleware(['auth'])->group(function () {
    Route::get('/reviews-form', [ReviewController::class, 'createReview'])->name('reviews.form');
    Route::post('/reviews-form', [ReviewController::class, 'store'])->name('reviews.store');
  });
});