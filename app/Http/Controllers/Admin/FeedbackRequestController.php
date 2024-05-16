<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\FeedbackRequest;
use Exception;

class FeedbackRequestController extends Controller
{
  // Метод для отображения списка заявок на обратную связь
  public function index()
  {
    // Получаем все заявки на обратную связь из базы данных
    $feedbackRequests = FeedbackRequest::all();

    // Отображаем страницу управления заявками на обратную связь
    return view('admin.manage_feedback_requests', compact('feedbackRequests'));
  }

  // Метод для удаления заявки на обратную связь
  public function destroy($id)
  {
    try {
      // Находим заявку по переданному идентификатору
      $feedbackRequest = FeedbackRequest::findOrFail($id);

      // Если у заявки есть файл, удаляем его из хранилища
      if ($feedbackRequest->file_path) {
        $publicFilePath = 'public/' . $feedbackRequest->file_path;
        Storage::delete($publicFilePath);
      }

      // Удаляем заявку из базы данных
      $feedbackRequest->delete();

      // Возвращаем JSON-ответ с сообщением об успешном удалении заявки
      return response()->json(['message' => 'Заявка успешно удалена']);
    } catch (Exception) {
      // Возвращаем JSON-ответ с сообщением об ошибке в случае неудачного удаления заявки
      return response()->json(['error' => 'Ошибка при удалении заявки'], 500);
    }
  }
}