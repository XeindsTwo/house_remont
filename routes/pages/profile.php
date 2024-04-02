<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
  Route::post('/profile/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
  Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
  Route::post('/profile/update-password', [ProfileController::class, 'updatePassword']);
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');