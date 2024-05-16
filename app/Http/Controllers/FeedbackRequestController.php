<?php

namespace App\Http\Controllers;

use App\Models\FeedbackRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FeedbackRequestController extends Controller
{
  /**
   * Создает новый фидбек-запрос.
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function store(Request $request)
  {
    // Валидация входных данных
    $validator = Validator::make($request->all(), [
      'name_feedback' => 'required|string|max:70|regex:/^[А-Яа-яЁё\s\-]+$/u',
      'phone_feedback' => 'required|string|max:20',
      'comment_feedback' => 'nullable|string|max:2000',
      'file' => 'nullable|file|max:15024',
    ]);

    // Если валидация не прошла, возвращаем ошибку с сообщением о неверных данных
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    // Определяем максимальное количество запросов и время "отката" для рейт-лимитера
    $maxRequests = 3;
    $decayInSeconds = 1800; // 30 минут = 1800 секунд

    // Генерируем ключ для рейт-лимитера на основе IP адреса пользователя
    $key = 'feedback_requests_' . $request->ip();

    // Проверяем, не превышено ли максимальное количество запросов
    if (!RateLimiter::tooManyAttempts($key, $maxRequests)) {
      // Если запросы еще разрешены, увеличиваем счетчик запросов
      RateLimiter::hit($key, $decayInSeconds);

      try {
        // Инициализируем переменную для пути к файлу
        $filePath = null;

        // Если загружен файл, сохраняем его
        if ($request->hasFile('file')) {
          $file = $request->file('file');
          $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
          $filePublicPath = $file->storeAs('public/feedback_files', $fileName);
          $filePath = Str::replaceFirst('public/', '', $filePublicPath);
        }

        // Создаем новый фидбек-запрос в базе данных
        $feedbackRequest = FeedbackRequest::create([
          'name_feedback' => $request->name_feedback,
          'phone_feedback' => $request->phone_feedback,
          'comment_feedback' => $request->comment_feedback,
          'file_path' => $filePath,
        ]);

        // Возвращаем успешный ответ с сообщением о создании фидбек-запроса и информацией о нем
        return response()->json(['message' => 'Фидбек-запрос успешно создан', 'feedback_request' => $feedbackRequest], 201, [], JSON_UNESCAPED_UNICODE);
      } catch (Exception $e) {
        // В случае ошибки при обработке запроса возвращаем ошибку сервера
        return response()->json(['error' => 'Ошибка при обработке запроса: ' . $e->getMessage()], 500, [], JSON_UNESCAPED_UNICODE);
      }
    } else {
      // Если превышено максимальное количество запросов, возвращаем ошибку с информацией о времени, через которое запросы снова будут разрешены
      $retryAfter = RateLimiter::availableIn($key);
      return response()->json(['error' => 'Превышено максимальное количество запросов. Пожалуйста, попробуйте снова через ' . $retryAfter . ' секунд.'], 429, [], JSON_UNESCAPED_UNICODE);
    }
  }
}