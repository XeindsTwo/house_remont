<?php

use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin/articles')->group(function () {
  Route::get('/', [ArticleController::class, 'index'])->name('admin.articles.index');
  Route::get('/create', [ArticleController::class, 'create'])->name('admin.articles.create');
  Route::post('/', [ArticleController::class, 'store'])->name('admin.articles.store');
  Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
  Route::post('/{article}', [ArticleController::class, 'update'])->name('admin.articles.update');
  Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');
});