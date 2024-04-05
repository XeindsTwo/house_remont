<?php

use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin/reviews')->group(function () {
  Route::get('/', [ReviewController::class, 'index'])->name('admin.reviews');
  Route::get('/approved', [ReviewController::class, 'indexApproved'])->name('admin.reviews.approved');
  Route::delete('/approved/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.approved.destroy');
  Route::put('/approved/{id}/approve', [ReviewController::class, 'approve'])->name('admin.reviews.approved.approve');
});