<?php

use App\Http\Controllers\FeedbackRequestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
  Route::get('/', [HomeController::class, 'index'])->name('index');
  Route::post('/feedback-request',
    [FeedbackRequestController::class, 'store'])
    ->name('feedback-request.store');
});