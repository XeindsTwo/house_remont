<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function register(Request $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    DB::beginTransaction();
    try {
      $validatedData = $request->validate([
        'login' => 'required|string|min:5|max:60|unique:users|regex:/^[a-zA-Z0-9_]+$/',
        'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|max:60|regex:/^[a-zA-Z0-9_]+$/',
      ]);

      User::create([
        'login' => $validatedData['login'],
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => 'USER',
      ]);

      DB::commit();
      return redirect('login')->with('success', 'Регистрация прошла успешно!');
    } catch (Exception) {
      DB::rollBack();
      return redirect('/503_error');
    }
  }

  public function showRegisterForm(): Factory|Application|View|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
  {
    if (Auth::check()) {
      return redirect('/');
    }
    return view('register');
  }
}