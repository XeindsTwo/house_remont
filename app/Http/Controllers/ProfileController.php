<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    return view('profile', ['user' => $user]);
  }

  public function updateAvatar(Request $request)
  {
    $request->validate([
      'avatar' => 'required|image|mimes:webp,png,jpg,jpeg|max:3072',
    ]);

    $user = Auth::user();
    if ($user->avatar) {
      Storage::delete('public/avatars/' . $user->avatar);
    }

    $avatarFile = $request->file('avatar');
    $avatarName = $avatarFile->hashName();

    try {
      $avatarFile->storeAs('public/avatars', $avatarName);
      $user->avatar = $avatarName;
      $user->save();
      return response()->json(['message' => 'Аватар успешно обновлен', 'avatar' => $user->avatar]);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при обновлении аватара: ' . $e->getMessage()], 500);
    }
  }

  public function updateProfile(Request $request)
  {
    try {
      $request->validate([
        'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
        'email' => [
          'required',
          'email',
          Rule::unique('users')->ignore(Auth::id()),
        ],
      ]);

      $user = Auth::user();
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->save();

      return response()->json(['message' => 'Данные профиля успешно обновлены', 'user' => $user]);
    } catch (ValidationException $e) {
      return response()->json(['error' => $e->validator->errors()], 422);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при обновлении данных: ' . $e->getMessage()], 500);
    }
  }

  public function updatePassword(Request $request)
  {
    try {
      $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|max:60|regex:/^[a-zA-Z0-9_]+$/',
        'confirm_password' => 'required|string|same:new_password',
      ]);

      $user = Auth::user();
      if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['error' => 'Текущий пароль неверный'], 401, [], JSON_UNESCAPED_UNICODE);
      }

      if ($request->current_password === $request->new_password) {
        return response()->json(['error' => 'Новый пароль должен отличаться от текущего'], 400, [], JSON_UNESCAPED_UNICODE);
      }

      if ($request->new_password != $request->confirm_password) {
        return response()->json(['error' => 'Новый пароль и подтверждение пароля не совпадают'], 402, [], JSON_UNESCAPED_UNICODE);
      }

      $user->password = Hash::make($request->new_password);
      $user->save();
      return response()->json(['message' => 'Ваш пароль успешно обновлен!'], 200, [], JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при обновлении пароля: ' . $e->getMessage()], 500, [], JSON_UNESCAPED_UNICODE);
    }
  }
}