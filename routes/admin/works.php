<?php

use App\Http\Controllers\Admin\WorkController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'checkdb'])->prefix('admin/works')->group(function () {
  Route::get('/', [WorkController::class, 'index'])->name('admin.works');
  Route::delete('/{id}', [WorkController::class, 'destroy'])->name('admin.works.delete');
  Route::get('/create', [WorkController::class, 'createWork'])->name('admin.works.page');
  Route::post('/create', [WorkController::class, 'store'])->name('admin.works.create');
  Route::get('/{id}/edit', [WorkController::class, 'edit'])->name('admin.works.edit');
  Route::put('/{id}', [WorkController::class, 'update'])->name('admin.works.update');
});