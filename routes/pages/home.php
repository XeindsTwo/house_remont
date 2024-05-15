<?php

use App\Http\Controllers\FeedbackRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepairEstimateController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'checkdb'], static function () {
  Route::get('/', [HomeController::class, 'index'])->name('index');
  Route::post('/feedback-request',
    [FeedbackRequestController::class, 'store'])
    ->name('feedback-request.store');
  Route::post('/repair-estimate',
    [RepairEstimateController::class, 'store'])
    ->name('repair-estimate.store');
});