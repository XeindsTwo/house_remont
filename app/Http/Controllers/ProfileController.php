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
  /**
   * Отображает профиль текущего пользователя.
   *
   * @return \Illuminate\View\View
   */
  public function show()
  {
    // Получаем текущего пользователя
    $user = Auth::user();

    // Возвращаем представление профиля, передавая данные пользователя
    return view('profile', ['user' => $user]);
  }

  /**
   * Обновляет аватар текущего пользователя.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function updateAvatar(Request $request)
  {
    // Валидируем входные данные
    $request->validate([
      'avatar' => 'required|image|mimes:webp,png,jpg,jpeg|max:3072',
    ]);

    // Получаем текущего пользователя
    $user = Auth::user();

    // Удаляем предыдущий аватар пользователя, если он существует
    if ($user->avatar) {
      Storage::delete('public/avatars/' . $user->avatar);
    }

    // Сохраняем новый аватар пользователя
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

  /**
   * Обновляет профиль текущего пользователя.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function updateProfile(Request $request)
  {
    try {
      // Валидируем входные данные
      $request->validate([
        'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
        'email' => [
          'required',
          'email',
          Rule::unique('users')->ignore(Auth::id()),
        ],
      ]);

      // Получаем текущего пользователя
      $user = Auth::user();

      // Обновляем данные профиля пользователя
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->save();

      // Возвращаем успешный ответ с сообщением об успешном обновлении данных профиля
      return response()->json(['message' => 'Данные профиля успешно обновлены', 'user' => $user]);
    } catch (ValidationException $e) {
      // Возвращаем ошибку валидации, если таковая имеется
      return response()->json(['error' => $e->validator->errors()], 422);
    } catch (Exception $e) {
      // Возвращаем общую ошибку при обновлении данных профиля
      return response()->json(['error' => 'Ошибка при обновлении данных: ' . $e->getMessage()], 500);
    }
  }

  /**
   * Обновляет пароль текущего пользователя.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function updatePassword(Request $request)
  {
    try {
      // Валидируем входные данные
      $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|max:60|regex:/^[a-zA-Z0-9_]+$/',
        'confirm_password' => 'required|string|same:new_password',
      ]);

      // Получаем текущего пользователя
      $user = Auth::user();

      // Проверяем соответствие текущего пароля
      if (!Hash::check($request->current_password, $user->password)) {
        return response()->json(['error' => 'Текущий пароль неверный'], 401, [], JSON_UNESCAPED_UNICODE);
      }

      // Проверяем, чтобы новый пароль отличался от текущего
      if ($request->current_password === $request->new_password) {
        return response()->json(['error' => 'Новый пароль должен отличаться от текущего'], 400, [], JSON_UNESCAPED_UNICODE);
      }

      // Проверяем, чтобы новый пароль совпадал с подтверждением
      if ($request->new_password != $request->confirm_password) {
        return response()->json(['error' => 'Новый пароль и подтверждение пароля не совпадают'], 402, [], JSON_UNESCAPED_UNICODE);
      }

      // Обновляем пароль пользователя
      $user->password = Hash::make($request->new_password);
      $user->save();

      // Возвращаем успешный ответ с сообщением об успешном обновлении пароля
      return response()->json(['message' => 'Ваш пароль успешно обновлен!'], 200, [], JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
      // Возвращаем общую ошибку при обновлении пароля
      return response()->json(['error' => 'Ошибка при обновлении пароля: ' . $e->getMessage()], 500, [], JSON_UNESCAPED_UNICODE);
    }
  }
}