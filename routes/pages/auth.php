<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/check-email', function (Request $request) {
  $email = $request->input('email');
  $user = User::where('email', $email)->first();
  return response()->json([
    'exists' => !!$user,
  ]);
});

Route::post('/check-login', function (Request $request) {
  $login = $request->input('login');
  $user = User::where('login', $login)->first();
  return response()->json([
    'exists' => !!$user,
  ]);
});