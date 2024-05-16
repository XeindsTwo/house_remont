<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
  // Метод для отображения списка неодобренных отзывов
  public function index()
  {
    // Получаем все неодобренные отзывы из базы данных
    $unapprovedReviews = Review::where('status', 0)->get();

    // Отображаем страницу управления неодобренными отзывами
    return view('admin.manage_reviews_unapproved', compact('unapprovedReviews'));
  }

  // Метод для отображения списка одобренных отзывов
  public function indexApproved()
  {
    // Получаем все одобренные отзывы из базы данных
    $approvedReviews = Review::where('status', 1)->get();

    // Отображаем страницу управления одобренными отзывами
    return view('admin.manage_reviews_approved', compact('approvedReviews'));
  }

  // Метод для удаления отзыва
  public function destroy($id): JsonResponse
  {
    // Находим отзыв по переданному идентификатору
    $review = Review::find($id);
    if (!$review) {
      return response()->json(['error' => 'Отзыв не найден'], 404);
    }

    // Удаляем отзыв из базы данных
    $review->delete();

    // Возвращаем JSON-ответ с сообщением об успешном удалении отзыва
    return response()->json(['message' => 'Отзыв успешно удален']);
  }

  // Метод для одобрения отзыва
  public function approve($id): JsonResponse
  {
    // Находим отзыв по переданному идентификатору
    $review = Review::find($id);
    if (!$review) {
      return response()->json(['error' => 'Отзыв не найден'], 404);
    }

    // Проверяем, был ли отзыв уже одобрен
    if ($review->status === 1) {
      return response()->json(['error' => 'Отзыв уже одобрен'], 400);
    }

    // Устанавливаем статус одобрения для отзыва и сохраняем изменения
    $review->status = 1;
    $review->save();

    // Возвращаем JSON-ответ с сообщением об успешном одобрении отзыва
    return response()->json(['message' => 'Отзыв успешно одобрен']);
  }
}