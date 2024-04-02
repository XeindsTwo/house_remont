<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\FeedbackRequest;
use Exception;

class FeedbackRequestController extends Controller
{
  public function index()
  {
    $feedbackRequests = FeedbackRequest::all();
    return view('admin.manage_feedback_requests', compact('feedbackRequests'));
  }

  public function destroy($id)
  {
    try {
      $feedbackRequest = FeedbackRequest::findOrFail($id);

      if ($feedbackRequest->file_path) {
        $publicFilePath = 'public/' . $feedbackRequest->file_path;
        Storage::delete($publicFilePath);
      }

      $feedbackRequest->delete();
      return response()->json(['message' => 'Заявка успешно удалена']);
    } catch (Exception) {
      return response()->json(['error' => 'Ошибка при удалении заявки'], 500);
    }
  }
}