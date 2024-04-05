<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::middleware(['checkdb'])->prefix('works')->group(function () {
  Route::get('/', [PortfolioController::class, 'index'])->name('page.works');
  Route::get('/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');
});