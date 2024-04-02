<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login(Request $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    $credentials = $request->only('login', 'password');
    try {
      if (Auth::attempt($credentials)) {
        return redirect('/');
      } else {
        return redirect()->back()->withErrors([
          'login' => 'Неверно введен логин или пароль',
        ]);
      }
    } catch (Exception) {
      return redirect('/503_error');
    }
  }

  public function showLoginForm(): Factory|Application|View|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
  {
    if (Auth::check()) {
      return redirect('/');
    }

    return view('login');
  }

  public function logout(Request $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
  }
}