<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
  public function index()
  {
    $unapprovedReviews = Review::where('status', 0)->get();
    return view('admin.manage_reviews_unapproved', compact('unapprovedReviews'));
  }

  public function indexApproved()
  {
    $approvedReviews = Review::where('status', 1)->get();
    return view('admin.manage_reviews_approved', compact('approvedReviews'));
  }

  public function destroy($id): JsonResponse
  {
    $review = Review::find($id);
    if (!$review) {
      return response()->json(['error' => 'Отзыв не найден'], 404);
    }

    $review->delete();
    return response()->json(['message' => 'Отзыв успешно удален']);
  }

  public function approve($id): JsonResponse
  {
    $review = Review::find($id);
    if (!$review) {
      return response()->json(['error' => 'Отзыв не найден'], 404);
    }

    if ($review->status === 1) {
      return response()->json(['error' => 'Отзыв уже одобрен'], 400);
    }

    $review->status = 1;
    $review->save();
    return response()->json(['message' => 'Отзыв успешно одобрен']);
  }
}