<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::middleware(['checkdb'])->prefix('blog')->group(function () {
  Route::get('/', [BlogController::class, 'index'])->name('blog');
  Route::get('/{article}', [BlogController::class, 'show'])->name('blog.article');
});