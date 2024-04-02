<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
  public function index()
  {
    $reviews = Review::where('status', true)->get();
    return view('reviews.index', compact('reviews'));
  }

  public function createReview()
  {
    return view('reviews.reviews-form');
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'content' => 'required|string|max:2400',
      'photo' => 'required|file|max:3048|mimes:jpeg,jpg,png,webp',
      'phone' => 'required|string|max:20',
      'name' => 'required|string|min:2|max:50|regex:/^[А-Яа-яЁё\s\-]+$/u',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }

    $maxRequests = 2;
    $decayInSeconds = 1800; // 30 минут
    $key = 'review_requests_' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, $maxRequests)) {
      RateLimiter::availableIn($key);
      return response()->json(['error' => 'Превышено максимальное количество запросов. Пожалуйста, попробуйте позже'], 429);
    }

    try {
      $user = Auth::user();
      $reviewData = $request->only('content', 'phone', 'name');
      $reviewData['user_id'] = $user->id;

      $filePath = null;
      if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $filePublicPath = $file->storeAs('public/reviews', $fileName);
        $filePath = Str::replaceFirst('public/', '', $filePublicPath);
        $reviewData['photo'] = $filePath;
      }

      $review = Review::create($reviewData);
      RateLimiter::hit($key, $decayInSeconds);
      return response()->json(['message' => 'Отзыв успешно отправлен. Ожидайте проверки отзыва администрацией', 'review' => $review]);
    } catch (Exception $e) {
      return response()->json(['error' => 'Ошибка при обработке запроса'], 500);
    }
  }
}