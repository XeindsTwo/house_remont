<?php

use App\Http\Controllers\Admin\FeedbackRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin')->group(function () {
  Route::get('/feedback-requests', [FeedbackRequestController::class, 'index'])->name('admin.feedback-request');
  Route::delete('/feedback-requests/{id}', [FeedbackRequestController::class, 'destroy'])->name('admin.feedback-request.destroy');
});