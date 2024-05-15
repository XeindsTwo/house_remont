<?php

use App\Http\Controllers\Admin\RepairEstimateController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin/estimates')->group(function () {
  Route::get('/', [RepairEstimateController::class, 'index'])->name('admin.estimates');
  Route::delete('/{id}', [RepairEstimateController::class, 'destroy']);
});