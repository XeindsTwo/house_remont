<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ReviewController extends Controller
{
  /**
   * Отображает список активных отзывов.
   *
   * @return View
   */
  public function index()
  {
    // Получаем все активные отзывы из базы данных
    $reviews = Review::where('status', true)->get();

    // Возвращаем представление, передавая список отзывов
    return view('reviews.index', compact('reviews'));
  }

  /**
   * Отображает форму для создания нового отзыва.
   *
   * @return View
   */
  public function createReview()
  {
    // Возвращаем представление с формой для отправки нового отзыва
    return view('reviews.reviews-form');
  }

  /**
   * Сохраняет новый отзыв в базу данных.
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function store(Request $request)
  {
    // Проверяем входные данные от пользователя
    $validator = Validator::make($request->all(), [
      'content' => 'required|string|max:2400',
      'photo' => 'required|file|max:3048|mimes:jpeg,jpg,png,webp',
      'phone' => 'required|string|max:20',
      'name' => 'required|string|min:2|max:50|regex:/^[А-Яа-яЁё\s\-]+$/u',
    ]);

    // Если валидация не прошла, возвращаем ошибку с сообщением о неверных данных
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    // Устанавливаем ограничения на количество запросов от одного IP адреса
    $maxRequests = 2;
    $decayInSeconds = 1800; // 30 минут
    $key = 'review_requests_' . $request->ip();

    // Проверяем, не превышено ли максимальное количество запросов
    if (RateLimiter::tooManyAttempts($key, $maxRequests)) {
      RateLimiter::availableIn($key);
      return response()->json(['error' => 'Превышено максимальное количество запросов. Пожалуйста, попробуйте позже'], 429);
    }

    try {
      // Получаем текущего пользователя
      $user = Auth::user();

      // Извлекаем данные отзыва из запроса
      $reviewData = $request->only('content', 'phone', 'name');

      // Присваиваем идентификатор пользователя отзыву
      $reviewData['user_id'] = $user->id;

      // Если загружено изображение, сохраняем его
      $filePath = null;
      if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $filePublicPath = $file->storeAs('public/reviews', $fileName);
        $filePath = Str::replaceFirst('public/', '', $filePublicPath);
        $reviewData['photo'] = $filePath;
      }

      // Создаем новый отзыв в базе данных
      $review = Review::create($reviewData);

      // Увеличиваем счетчик запросов пользователя
      RateLimiter::hit($key, $decayInSeconds);

      // Возвращаем успешный ответ с сообщением о сохранении отзыва
      return response()->json(['message' => 'Отзыв успешно отправлен. Ожидайте проверки отзыва администрацией', 'review' => $review]);
    } catch (Exception $e) {
      // В случае ошибки возвращаем сообщение об ошибке сервера
      return response()->json(['error' => 'Ошибка при обработке запроса'], 500);
    }
  }
}